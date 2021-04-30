<?php

namespace Database\Factories;

use App\Models\PartnershipConditions;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnershipConditionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PartnershipConditions::class;

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
