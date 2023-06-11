<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class user extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('admins')->truncate();
        echo "done";
    }
}
