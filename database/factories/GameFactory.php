<?php

namespace Database\Factories;

use App\Models\game;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'age' => $this->faker->randomDigit(),
            'gender' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 0 , 100),
            'description' => $this->faker->text(),
            'photo' => $this->faker->imageUrl()
        ];
    }
}
