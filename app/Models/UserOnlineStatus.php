<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

trait UserOnlineStatus
{
    public function markAsOnline()
    {
        $this->is_online = true;
        $this->last_seen_at = now();
        $this->save();
        broadcast(new \App\Events\UserStatusChanged($this, true))->toOthers();
    }

    public function markAsOffline()
    {
        $this->is_online = false;
        $this->last_seen_at = now();
        $this->save();
        broadcast(new \App\Events\UserStatusChanged($this, false))->toOthers();
    }

    public function isOnline()
    {
        return $this->is_online && 
               $this->last_seen_at && 
               $this->last_seen_at->diffInMinutes(now()) < 5;
    }

    public static function updateOnlineStatus()
    {
        User::where('is_online', true)
            ->where('last_seen_at', '<', now()->subMinutes(5))
            ->update([
                'is_online' => false
            ]);
    }
}
