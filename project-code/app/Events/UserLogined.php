<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLogined
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $user;

    public $ip;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, $ip)
    {
        $this->user = $user;
        $this->ip = $ip;
    }
}
