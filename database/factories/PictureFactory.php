<?php

namespace Database\Factories;

use App\Models\Picture;
use Illuminate\Database\Eloquent\Factories\Factory;

class PictureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Picture::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $word = $this->faker->word();

        return [
            'name' => $word,
            'description' => $word,
            'path' => $this->faker->image(
                'public/storage/gallery',
                1920,
                1080,
                null,
                false,
                false,
                $word
            ),
        ];
    }
}
