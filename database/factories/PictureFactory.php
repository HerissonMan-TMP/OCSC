<?php

namespace Database\Factories;

use App\Models\Picture;
use Illuminate\Database\Eloquent\Factories\Factory;
use Storage;

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

        $url = $this->faker->imageUrl(
            1920,
            1080,
            null,
            false,
            $word
        );

        $filename = uniqid('img_', true) . '.png';
        $contents = file_get_contents($url);

        Storage::put('gallery/' . $filename, $contents);

        return [
            'name' => $word,
            'description' => $word,
            'path' => $filename,
        ];
    }
}
