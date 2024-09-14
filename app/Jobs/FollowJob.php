<?php

namespace App\Jobs;

use App\Models\Following;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FollowJob implements ShouldQueue
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
        Following::firstOrCreate([
            'following_id' => $this->followingId,
            'follower_id' => $this->followerId,
        ]);
        User::find($this->followingId)->increment('following');
        User::find($this->followerId)->increment('followers');
    }
}
