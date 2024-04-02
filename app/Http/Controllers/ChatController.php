<?php

namespace App\Http\Controllers;

use App\Events\SendNotification;
use Illuminate\Http\Request;

class ChatController extends Controller
{

   public  function sendpusher(){
       $data = [ 'title'=>'test name', 'desc'=>'test name 2' ];
       event(new SendNotification($data,'my-channel','my-event'));
   }
}
