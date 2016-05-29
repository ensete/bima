<?php

namespace App\Http\Controllers;

class AboutController extends Controller {

    public function index() {
        $data = [];
        $data['title'] = "About";
        $data['content'] = "about";
        return view('index', $data);
    }

    public function test() {
        $test[] = ['name'=>'user1', 'email'=>'user1@gmail.com'];
        $test[] = ['name'=>'user2', 'email'=>'user2@gmail.com'];
        $test[] = ['name'=>'user3', 'email'=>'user3@gmail.com'];
        $test[] = ['name'=>'user4', 'email'=>'user4@gmail.com'];
        $test[] = ['name'=>'user5', 'email'=>'user5@gmail.com'];
        return response()->json($test)->setCallback('callback');
    }

}