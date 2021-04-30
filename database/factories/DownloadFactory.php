<?php

namespace Database\Factories;

use App\Models\Download;
use Illuminate\Database\Eloquent\Factories\Factory;

class DownloadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Download::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence(3, false),
            'original_file_name' => $this->faker->sentence(2, false) . $this->faker->fileExtension(),
            'path' => $this->faker->filePath(),
        ];
    }
}
