<?php

namespace App\Console\Commands;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Http\Resources\CpuResource;

class CpuCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cpu:cron';

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
        //

        $data = ['query']; //place query here
        $datad = new CpuResource($data);

        $client = new \GuzzleHttp\Client();
        $request = $client->post('http://localhost:8000/api/cpu', [
            'json' => $datad
        ]);

        $response = $request->getBody();

        Log::info($response);
    }
}
