<?php

use App\Broadcasting\DirectMessaging;
use App\Broadcasting\GroupChat;
use App\Broadcasting\UserStatus;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('messages.{senderId}.{receiverId}',DirectMessaging::class);
Broadcast::channel('group.{groupId}',GroupChat::class );
Broadcast::channel('user-status',UserStatus::class );


