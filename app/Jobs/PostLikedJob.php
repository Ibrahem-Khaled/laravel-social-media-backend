<?php

namespace App\Jobs;

use App\Notifications\PostLikedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostLikedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $post;
    public $user;
    /**
     * Create a new job instance.
     */
    public function __construct($post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $this->post->likes()->create(['user_id' => $this->user->id]);

        $this->post->increment('like');

        $this->post->user->notify(new PostLikedNotification($this->user, $this->post));
    }
}
