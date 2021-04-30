<?php

namespace Database\Factories;

use App\Models\ConvoyRules;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConvoyRulesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConvoyRules::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content' => $this->faker->markdown(),
        ];
    }
}
