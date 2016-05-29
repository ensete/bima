<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;

class AdminController extends Controller {

    public function index() {

    }

    public function get_messages() {
        adminAuthentication(true);
        $messages = Contact::orderBy('created_at', 'DESC')->get();
        $data['title'] = "Messages";
        $data['content'] = "admin.message";
        $data['messages'] = $messages;
        return view('index', $data);
    }

    public function get_users() {
        adminAuthentication(true);
        $users = User::orderBy('created_at', 'DESC')->get();
        $data['title'] = "Users";
        $data['content'] = "admin.user";
        $data['users'] = $users;
        return view('index', $data);
    }

}