<?php

namespace Database\Factories;

use App\Models\GlobalRequirements;
use Illuminate\Database\Eloquent\Factories\Factory;

class GlobalRequirementsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GlobalRequirements::class;

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
