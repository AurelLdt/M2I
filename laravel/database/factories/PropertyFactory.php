<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->randomElement(['Maison', 'Appartement', 'Garage', 'T3', 'Terrasse']),
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->numberBetween(25, 150) * 1000,
            'sold' => $this->faker->boolean,
            'user_id' => User::factory(),
        ];
    }
}
