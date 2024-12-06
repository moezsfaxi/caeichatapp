<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
 
    protected $fillable = ['message','sender_id','group_id'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


}
