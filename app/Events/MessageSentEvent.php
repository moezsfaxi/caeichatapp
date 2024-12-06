<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MessageSentEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $senderId;
    public int $receiverId;
    public string $message; 

    /**
     * Create a new event instance.
     */
    public function __construct(int $senderId,int $receiverId ,string $message)
    {
       $this->senderId = $senderId;
       $this->receiverId = $receiverId;
       $this->message = $message;
       //Log::info('from the constructer' ,['senderid' => $this->senderId,'receiverid'=> $this->receiverId,'message'=> $this->message ]); 

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('messages.' . $this->senderId . '.' . $this->receiverId),
        ];
    }
    public function broadcastWith()
    {
        return [
            'message' => $this->message ,
            'senderid' => $this->senderId,
            'receiverid'=> $this->receiverId
        ];
    }

}
