<?php

namespace App\Console\Commands;

use App\Models\FrameUser;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredFrames extends Command
{
    // Command signature
    protected $signature = 'transactions:delete-expired';

    // Command description
    protected $description = 'Delete transactions that have expired';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get expired transactions
        $expiredTransactions = FrameUser::where('expires_at', '<', Carbon::now())->get();

        // Delete each expired transaction
        foreach ($expiredTransactions as $transaction) {
            $transaction->delete();
        }

        $this->info('Expired transactions deleted successfully.');
    }
}
