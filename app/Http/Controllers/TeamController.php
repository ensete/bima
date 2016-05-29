<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
use Illuminate\Http\Request;
use App\Team;

class TeamController extends Controller {

    public function get_create_team() {
        $data = [];
        $data['title'] = 'Create Team';
        $data['content'] = "team.create_team";
        return view('index', $data);
    }

    public function create_team(Request $request) {
        $user = userAuthentication();
        if($user) {
            $rules  =  [
                'name'    => 'required|unique:teams|min:4|max:25',
                'description' => 'required',
            ];
            $messages = [
                'required'    => 'Team :attribute must be in presence.',
                'unique'    => '":attribute" belongs to another team.',
                'min' => 'Team :attribute must be between :min - 25 characters.',
                'max' => 'Team :attribute must be between 4 - :max characters.',
            ];
            $this->validate($request, $rules, $messages);

            $team = new Team();
            $team->user_id = $user->id;
            $team->name = $request->name;
            $team->description = $request->description;
            $team->emblem= rand(1, config('app.total_avatars')) . '.jpg';
            $team->save();

            $user->team_id = $team->id;
            $user->save();
            $user->roles()->attach([11]);

            return redirect("/user/profile/$user->username")->with('success', 'Your team is now ready');
        }
        return redirect('/');
    }

    public function invite($user_id) {
        User::find($user_id)->update(['team_id' => 1]);
        return redirect()->back()->with('success', 'Success');
    }

    public function assign($username, $role_id) {
        $user = User::where('username', $username)->first();
        $user->roles()->attach([$role_id]);
        return redirect("/user/profile/$user->username")->with('success', 'Success');
    }

}