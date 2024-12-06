<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Events\MessageSentEvent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        
        $data = $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'message' => 'required',
        ]);
        
        
        $message = Message::create([
            'sender_id' => $data['sender_id'],
            'receiver_id' => $data['receiver_id'],
            'message' => $data['message'],
        ]);
        //Log::info('Received message request:', [ "text" =>  $message->message]);

        
  
        MessageSentEvent::dispatch($message->sender_id,$message->receiver_id,$message->message);
         
        return response()->json(['status' => 'Message sent successfully!']);
    }

    public function create($receiverId){

        $senderId= Auth::id();
      
        $messages = Message::where(function($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                  ->where('receiver_id', $receiverId);
        })
        ->orWhere(function($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                  ->where('receiver_id', $senderId);
        })
        ->orderBy('created_at', 'asc') 
        ->get();
        $otherside = User::findOrFail($receiverId) ;
        $otname=$otherside->name  ;

        return View('chat.sending',compact('messages' ,'receiverId' ,'otname'));
    }


    public function userlist (){

        $userid =Auth::id();
        $users = User::where('id', '!=', $userid)->get();

        return View('chat.userlist',compact('users'));
    }




}
