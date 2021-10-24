<?php

namespace Database\Factories;

use App\Models\Nft;
use Illuminate\Database\Eloquent\Factories\Factory;

class NftFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nft::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->name(),
            'creator_id' => $this->faker->numberBetween(1, 4),
            'owner_id' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->realText(100, 2),
            'collection_id' => $this->faker->numberBetween(1, 5),
            'object_type' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1, 50), 
            'area' => $this->faker->numberBetween(1, 100)
        ];
    }
}
