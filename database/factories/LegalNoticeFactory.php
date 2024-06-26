<?php

namespace Database\Factories;

use App\Models\LegalNotice;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegalNoticeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = LegalNotice::class;

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
