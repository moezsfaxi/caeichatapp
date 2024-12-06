<?php

namespace App\Broadcasting;

use App\Models\User;

class DirectMessaging
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Authenticate the user's access to the channel.
     */
    public function join(): bool
    {
        // Check if the user is either the sender or the receiver
        //return $user->id === (int) $senderId || $user->id === (int) $receiverId;
        // ***test matansehech ***
        return true;
    }
}
