<?php

namespace App\Events;

use App\Models\Patient;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use function info;

class PatientEmailVerificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $patient;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Patient $patient)
    {
         $this->patient = $patient;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [];
        // return new PrivateChannel('channel-name');
    }
}
