<?php

namespace App\Jobs;

use App\Models\Following;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UnfollowJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $followingId;
    public $followerId;
    /**
     * Create a new job instance.
     */
    public function __construct($followingId, $followerId)
    {
        $this->followingId = $followingId;
        $this->followerId = $followerId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Following::where([
            'following_id' => $this->followingId,
            'follower_id' => $this->followerId,
        ])->delete();
        
        User::find($this->followingId)->decrement('following');
        User::find($this->followerId)->decrement('followers');
    }
}
