<?php

namespace App\Http\Controllers;

use App\Events\GroupMessageSentEvent;
use App\Models\Group;
use App\Models\GroupMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GroupMessageController extends Controller
{
    public function send(Request $request)
    {
      
        $data = $request->validate([
            'sender_id' => 'required',
            'group_id' => 'required',
            'message' => 'required',
        ]);
        
        
        $message = GroupMessage::create([
            'sender_id' => $data['sender_id'],
            'group_id' => $data['group_id'],
            'message' => $data['message'],
        ]);

        $dateofcreation= Carbon::parse($message->created_at)->format('h:i A | M d');
        //Log::info('Received message request:', [ "text" =>  $message->message]);
 
        broadcast(new GroupMessageSentEvent($message->message, $message->group_id , $dateofcreation))->toOthers();
        return response()->json(['status' => 'Message sent successfully!']);
    }



    public function groupslist(){

        $userid =Auth::id();
        $groups = Auth::user()->groups;
        $users = User::where('id', '!=', $userid)->get();

        return View('chat.groupslist',compact('groups','users'));
    }

    public function create($groupId){
        
        $messages = GroupMessage::where('group_id',$groupId)->get();

       // dd($messages);   

        return View('chat.groupsending',compact('messages','groupId'));
    }
    
    
    
    public function createagroup(Request $request)
    {
        // Get the selected users' IDs
        $selectedUsers = $request->input('selected_users');
        $groupname = $request->input('groupname') ;
        $group = Group::create(['name' => $groupname]);
        
        if ($selectedUsers) {
            $group->users()->attach($selectedUsers);
            $group->users()->attach(Auth::user()->id);
            Log::info($selectedUsers);

            
            // You can redirect or return a response after performing the action
            return redirect()->back()->with('success', 'Action performed on selected users.');
        } else {
            return redirect()->back()->with('error', 'No users selected.');
        }
    }




}
