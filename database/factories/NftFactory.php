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
            'image_file_path' => $this->faker->randomElement(['https://ipfs.io/ipfs/QmNLsX2CDs1xfGvzwVv4xyyg2sCXTjxJvjyP1RNtSLTK7d', 'https://ipfs.io/ipfs/QmSLkAjohVXnQFd7kEMrApG2Son9dwaMEtBJbitUrEgVwc', 'https://ipfs.io/ipfs/QmW4ujhxvW83pbb53aRSVZqM6gtZikGWT9u7osUzwotmik']),
            'price' => $this->faker->numberBetween(75, 400),
            'object_type' => $this->faker->name(),
            'area' => $this->faker->numberBetween(1, 100)
        ];
    }
}
