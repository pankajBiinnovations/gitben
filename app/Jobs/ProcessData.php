<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Mail;
class ProcessData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $info = array(
        'name' => "Alex"
    );
    Mail::send(['text' => 'mail'], $info, function ($message)
    {
        $message->to('pankaj.singh910025@gmail.com', 'W3SCHOOLS')
            ->subject('Basic test eMail from W3schools.');
        $message->from('pankaj.singh910025@gmail.com', 'Alex');
    });
    echo "Successfully sent the email";
    }
}
