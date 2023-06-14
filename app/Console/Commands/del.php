<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class del extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:del';

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
        DB::table('posts')->truncate();
        return "deleted";
    }
}
