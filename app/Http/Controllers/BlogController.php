<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class BlogController extends Controller {

    public function index() {
        $data = [];
        $data['title'] = "Blog";
        $data['content'] = "blog.list";
        $data['blogs'] = Blog::orderBy('id', 'DESC')->paginate(config('app.pagination'));
        return view('index', $data);
    }

    public function view($cleanUrl) {
        $blog = Blog::where('clean_url', $cleanUrl)->firstOrFail();
        $blog->views += 1;
        $blog->save();

        $user = adminAuthentication();

        $data = [];
        $data['title'] = "View";
        $data['content'] = "blog.view";
        $data['blog'] = $blog;
        $data['is_admin'] = $user['is_admin'];
        return view('index', $data);
    }

    public function add_blog() {
        $data = [];
        $data['title'] = "Add Blog";
        $data['content'] = "blog.form";
        $data['user'] = userAuthentication();
        return view('index', $data);
    }

    public function store_blog(Request $request) {
        $rules  =  [
            'user_id'    => 'required',
            'title'    => 'required|unique:blogs',
            'content' => 'required',
            'blog_banner' => 'required'
        ];
        $messages = [
            'required'    => 'The :attribute must be in presence.',
            'unique' => 'Duplicate entry'
        ];
        $this->validate($request, $rules, $messages);

        try {
            $data = $request->only('user_id', 'title', 'content');
            $data['clean_url'] = generateCleanUrl($request->title);
            $blog = Blog::create($data);

            $manager = new ImageManager();
            $banner = $manager->make($request->file('blog_banner'))->fit(920, 300);
            $banner->save('images/storage/blogs/'.$blog->id.'.jpg');

            return redirect('/blog/' . $data['clean_url'])->with('success', 'Success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit_blog($blog_id) {
        $blog = Blog::findOrFail($blog_id);

        $data = [];
        $data['title'] = "Edit Blog";
        $data['content'] = "blog.form";
        $data['user'] = userAuthentication();
        $data['blog'] = $blog;
        return view('index', $data);
    }

    public function update_blog(Request $request, $blog_id) {
        $rules  =  [
            'user_id'    => 'required',
            'title'    => 'required|unique:blogs,title,'.$blog_id,
            'content' => 'required'
        ];
        $messages = [
            'required'    => 'The :attribute must be in presence.',
            'unique' => 'Duplicate entry.'
        ];
        $this->validate($request, $rules, $messages);

        try {
            $blog = Blog::findOrFail($blog_id);
            $data = $request->only('user_id', 'title', 'content');
            $data['clean_url'] = generateCleanUrl($request->title);
            $blog->update($data);

            if ($request->file('blog_banner')) {
                $manager = new ImageManager();
                $banner = $manager->make($request->file('blog_banner'))->fit(920, 300);
                $banner->save('images/storage/blogs/'.$blog->id.'.jpg');
            }

            return redirect('/blog/' . $data['clean_url'])->with('success', 'Success');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}