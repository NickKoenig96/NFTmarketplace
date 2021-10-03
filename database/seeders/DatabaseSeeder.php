<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            // UserSeeder::class,
            // CollectionSeeder::class,
        ]);

        // \App\Models\Nft::factory(10)->create();
        \App\Models\Comment::factory(20)->create();
    }
}
