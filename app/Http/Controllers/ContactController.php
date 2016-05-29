<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller {

    public function index() {        
        $data = [];
        $data['title'] = "Contact";
        $data['content'] = "contact";
        return view('index', $data);
    }

    public function store_contact(Request $request) {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->back()->with('success', 'Thank you for raising your voice :) ');
    }

}