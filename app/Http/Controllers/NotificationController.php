<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller {

    public function send_message(Request $request) {
        $rules  =  [
            'user_id' => 'required',
            'sender_id' => 'required',
            'message' => 'required'
        ];
        $messages = [
            'required'    => 'The :attribute must be in presence.',
        ];
        $this->validate($request, $rules, $messages);

        $message = new Notification();
        $message->user_id = $request->user_id;
        $message->sender_id = $request->sender_id;
        $message->content = $request->message;
        $message->type = 1;
        $message->save();

        return response(['success'=>'Message sent :3']);
    }
}