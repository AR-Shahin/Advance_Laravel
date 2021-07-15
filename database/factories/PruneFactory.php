<?php

namespace Database\Factories;

use App\Models\Prune;
use Illuminate\Database\Eloquent\Factories\Factory;

class PruneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Prune::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'view' => rand(40, 100)
        ];
    }
}
