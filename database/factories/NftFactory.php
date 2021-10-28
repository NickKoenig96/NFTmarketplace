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
            'forSale' => $this->faker->numberBetween(0,1),
            'image_file_path' => $this->faker->randomElement(['https://res.cloudinary.com/dqelbnq5n/image/upload/v1635444084/Alderaan_planeet_hepk4w.webp', 'https://res.cloudinary.com/dqelbnq5n/image/upload/v1635444165/Mustafar-TROSGG_vzpuru.webp', 'https://res.cloudinary.com/dqelbnq5n/image/upload/v1635444245/Hoth_AoRCR_skga2j.webp']),
            'price' => $this->faker->numberBetween(75, 400),
            'object_type' => $this->faker->name(),
            'area' => $this->faker->numberBetween(1, 100)
        ];
    }
}
