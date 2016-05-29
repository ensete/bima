<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Bookmark;
use App\Pet;

class UserController extends Controller {

    public function profile($username) {
        $select = [
            'id', 'team_id', 'rank_id', 'pet_id', 'name', 'email', 'avatar',
            'phone', 'address', 'gender', 'facebook', 'about'
        ];

        $user = User::with(['rank', 'team', 'roles', 'pet'])->select($select)->where('username', $username)->firstOrFail();
        $currentUser = profileAuthentication($user->id, $user->team);
        $data = [];
        $data['title'] = "$user->name Profile";
        $data['content'] = 'user.profile';
        $data['currentUser'] = $currentUser;
        $data['customCss'] = true;
        $data['user'] = $user;
        return view('index', $data);
    }

    public function bookmarks() {
        $user = userAuthentication();
        if (!$user) {
            return redirect('/');
        }

        $user = User::with([
            'bookmarks',
            'bookmarks.manga' => function ($query) {
                $query->select(['id', 'name', 'clean_url', 'summary']);
            },
            'bookmarks.manga.latestChapter'
        ])->select('id')->find($user->id);

        $data = [];
        $data['title'] = "Bookmarks";
        $data['content'] = 'user.bookmarks';
        $data['user'] = $user;
        return view('index', $data);
    }

    public function remove_bookmark(Request $request) {
        $bookmark = Bookmark::find($request->id);
        if ($bookmark) {
            $bookmark->delete();
            return 1;
        }
        return 0;
    }

    public function login(Request $request) {
        $this->validate($request, [
            'username'    => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->back()->with('success', ':)');
        }
        return redirect()->back()->with('error', 'Your credentials are invalid :(');
    }

    public function register(Request $request) {
        $rules  =  [
            'username'    => 'required|unique:users|min:4|max:20',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:4|max:20'
        ];
        $messages = [
            'required'    => 'The :attribute must be in presence.',
            'unique'    => 'The :attribute belongs to an existing account.',
            'min' => 'The :attribute must be between :min - 20 characters.',
            'max' => 'The :attribute must be between 4 - :max characters.',
            'email' => "The email doesn't seem to be in right format",
            'confirmed'      => 'Your :attributes does not match.',
        ];
        $this->validate($request, $rules, $messages);

        User::create([
            'username' => $request->username,
            'name' => ucfirst($request->username),
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'avatar' => rand(1, 27) . '.jpg',
            'pet_id' => Pet::random()->id
        ]);

        return response(['success'=>':3']);
    }

    public function logout() {
        Auth::logout();
        return redirect()->back()->with('error', ":(");
    }

    public function get_edit_profile() {
        $user = userAuthentication();
        if(!$user) {
            redirect('/');
        }

        $data = [];
        $data['title'] = 'Edit Profile';
        $data['content'] = "user.edit_profile";
        $data['user'] = $user;
        return view('index', $data);
    }

    public function edit_profile(Request $request) {
        $rules  =  [
            'name'    => 'required|max:20',
            'gender' => 'required',
            'phone' => 'max:20',
            'address' => 'max:40',
            'facebook' => 'max:40',
            'about' => 'max:255'
        ];
        $messages = [
            'required'    => 'The :attribute must be in presence.',
            'max' => 'The :attribute must be :max characters at most.'
        ];
        $this->validate($request, $rules, $messages);

        $user = User::find($request->user_id);

        if(!$request->name) {
            $request->name = ucfirst($user->username);
        }

        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->facebook = $request->facebook;
        $user->about = $request->about;
        $user->save();
        return redirect("/user/profile/$user->username")->with('success', 'Your profile has been updated');
    }

}