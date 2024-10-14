<?php
namespace App\Events;

use App\Models\Thread;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ThreadLiked implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $thread;

    public function __construct(Thread $thread)
    {
        $this->thread = $thread;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('thread.' . $this->thread->id);
    }

    public function broadcastWith()
    {
        return [
            'thread_id' => $this->thread->id,
            'like_count' => $this->thread->likes()->count(), // 新しいいいねの数
        ];
    }
}
