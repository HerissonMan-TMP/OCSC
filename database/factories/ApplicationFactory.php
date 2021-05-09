<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $creationDateTime = $this->faker->dateTimeBetween('-1 week');

        return [
            'truckersmp_id' => $this->faker->randomNumber(7, false),
            'discord' => $this->faker->userName() . '#' . $this->faker->randomNumber(4, true),
            'email' => $this->faker->safeEmail(),
            'steam_profile' => 'https://steam.com/' . $this->faker->slug(),
            'trucksbook_profile' => 'https://trucksbook.eu/' . $this->faker->slug(),
            'age' => $this->faker->numberBetween(16, 99),
            'pc_configuration' => $this->faker->sentence(),
            'status' => 'new',
            'created_at' => $creationDateTime,
            'updated_at' => $creationDateTime
        ];
    }

    /**
     * Indicate that the application should be accepted.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function accepted()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'accepted'
            ];
        });
    }

    /**
     * Indicate that the application should be declined.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function declined()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'declined'
            ];
        });
    }
}
