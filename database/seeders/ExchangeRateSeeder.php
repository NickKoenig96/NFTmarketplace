<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ExchangeRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $r = new \App\Models\Rate();
        $r->name = 'eth';
        $r->rate = Http::get('https://min-api.cryptocompare.com/data/price?fsym=EUR&tsyms=ETH')['ETH'];
        $r->save();
    }
}
