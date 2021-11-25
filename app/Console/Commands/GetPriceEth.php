<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class GetPriceEth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:ethprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the price eth to euro';

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
     * @return int
     */
    public function handle()
    {
        $eth =  Http::get('https://min-api.cryptocompare.com/data/price?fsym=EUR&tsyms=ETH')['ETH'];
        
        return Command::SUCCESS;
    }
}
