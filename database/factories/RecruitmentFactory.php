<?php

namespace Database\Factories;

use App\Models\Recruitment;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecruitmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recruitment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start_at' => now()->subDays($this->faker->numberBetween(21, 40)),
            'end_at' => now()->subDays($this->faker->numberBetween(1, 20)),
            'note' => null,
            'specific_requirements' => 'The specific requirements with **markdown**.',
        ];
    }

    public function open()
    {
        return $this->state(function (array $attributes) {
            return [
                'start_at' => now()->subDays($this->faker->numberBetween(1, 20)),
                'end_at' => now()->addDays($this->faker->numberBetween(1, 20)),
            ];
        });
    }
}
