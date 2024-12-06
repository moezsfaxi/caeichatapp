<?php

namespace App\Broadcasting;

use App\Models\Group;
use App\Models\User;

class GroupChat
{
    /**
     * Create a new channel instance.
     */
    public function __construct()
    {
        //
    }

    public function join(User $user,$groupId): array|bool
    {
        $group = Group::find($groupId);

    if ($group && $group->users->contains($user->id)) {
        return ['id' => $user->id, 'name' => $user->name];
    }

    return false;
    }
}
