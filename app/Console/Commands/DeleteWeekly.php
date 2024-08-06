<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DeleteWeekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tables = ['cpu', 'backup_info','queries']; 

        foreach ($tables as $table) {
            $deletedRows = DB::table($table)
                ->where('created_at', '<', now()->subWeek())
                ->delete();

            Log::info("Deleted $deletedRows records from $table.");
        }

        return 0;

    }
}
