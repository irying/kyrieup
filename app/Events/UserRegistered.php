<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Impl\Repo\User\EloquentUser;
use Impl\Repo\User\UserInterface;
use Naux\Mail\SendCloudTemplate;

class UserRegistered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user;

    /**
     * Create a new event instance.
     *
     * @param EloquentUser $user
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->sendVerifyEmailTo($user);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    /**
     * @param $user
     */
    protected function sendVerifyEmailTo($user)
    {
        $data = [
            'url' => route('email.verify', ['token' => $user->confirmation_token]),
            'name' => $user->name
        ];
        $template = new SendCloudTemplate('kyrieup_register', $data);

        \Mail::raw($template, function ($message) use($user) {
            $message->from('jb@laravist.com', 'Laravel');

            $message->to($user->email);
        });
    }
}
