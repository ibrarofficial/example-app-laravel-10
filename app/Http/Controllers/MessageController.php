<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\NewMessageNotification ;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = Auth::user()->id;
        $data = array('user_id' => $user_id);

        return view('broadcast', $data);
    }

    public function send()
    {
        // ...

        // message is being sent
        $message = new Message;
        $message->setAttribute('from', 3);
        $message->setAttribute('to', 4);
        $message->setAttribute('message', 'Demo message from user 1 to user 2..');
        $message->save();

        // want to broadcast NewMessageNotification event
        //event(new NewMessageNotification ($message));

        // ...
    }

}
