<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserStatusController extends Controller
{
    public function heartbeat(Request $request)
    {
        $user = $request->user();
        $user->markAsOnline();


        return response()->json(['status' => 'success']);
    }

    public function getOnlineUsers()
    {
        
        $onlineUsers = User::where('is_online', true)
            ->where('last_seen_at', '>=', now()->subMinutes(5))
            ->get();
        
        return response()->json($onlineUsers);
    }
}
