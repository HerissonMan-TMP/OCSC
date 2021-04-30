<?php

namespace Database\Factories;

use App\Models\PartnerCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PartnerCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'opening_at' => null,
        ];
    }

    /**
     * Indicate that the partner category will open soon.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function openingSoon()
    {
        return $this->state(function (array $attributes) {
            return [
                'opening_at' => now()->addDays(5),
            ];
        });
    }

    /**
     * Indicate that the partner category is open.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function isOpen()
    {
        return $this->state(function (array $attributes) {
            return [
                'opening_at' => now()->subDays(2),
            ];
        });
    }
}
