<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMessage;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

use function Pest\Laravel\get;

class FullChatController extends Controller
{
    public function fullchat (){
        $userid =Auth::id();
        $users = User::where('id', '!=', $userid)->get();
        $groups = Group::withCount('Users')->get();
        $myname = Auth::user()->name;
        $groups = $groups->filter(function ($group) use ($userid) {
            return $group->users->contains('id', $userid);  
        });
        return View('chat.fullchat',compact('users','groups','myname'));
    }




    public function fetchMessages($receiverId)
    {

    $senderId = Auth::id();
    
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

    $otherSide = User::findOrFail($receiverId);
    $myname = Auth::user()->name;

    $formattedMessages = $messages->map(function ($message) {
        return [
            'id' => $message->id,
            'message' => $message->message,
            'sender_id' => $message->sender_id,
            'receiver_id' => $message->receiver_id,
            'created_at' => Carbon::parse($message->created_at)->format('h:i A | M d'), 
            'updated_at' => $message->updated_at,
        ];
    });


    return response()->json([
        'messages' => $formattedMessages,
        'receiverId' => $receiverId,
        'otherName' => $otherSide->name,
        'myname' => $myname
    ]);

    }
    public function fetchMessagesgroup($groupId)
    {
        $messages = GroupMessage::where('group_id', $groupId)
        ->with('sender') 
        ->get();

    
    $transformedMessages = $messages->map(function ($message) {
        return [
            'id' => $message->id,
            'message' => $message->message,
            'sender_id' => $message->sender_id,
            'sender_name' => $message->sender->name ?? 'Unknown', 
            'group_id' => $message->group_id,
            'created_at' => Carbon::parse($message->created_at)->format('h:i A | M d'),
            'updated_at' => $message->updated_at,
        ];
    });

    return response()->json([
        'messages' => $transformedMessages,
    ]);

    }




}
