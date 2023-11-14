<?php

namespace App\Console\Commands;

use App\Models\EmailVerificationModel;
use Illuminate\Console\Command;

class CleanExpiredEmailVerifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-expired-email-verifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'deleting expired email verification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        EmailVerificationModel::where("deadline", "<", now())->delete();
        $this->info("Expired email verification cleaned");
    }
}
