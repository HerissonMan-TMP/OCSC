<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Answer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'text' => $this->faker->sentence()
        ];
    }

    public function forMultilineQuestion()
    {
        return $this->state(function (array $attributes) {
            return [
                'text' => $this->faker->text(200)
            ];
        });
    }
}
