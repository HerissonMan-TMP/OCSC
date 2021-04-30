<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'logo' => $this->faker->imageUrl(500, 500),
            'truckersmp_link' => 'https://truckersmp.com/' . $this->faker->slug(),
            'trucksbook_link' => 'https://trucksbook.eu/' . $this->faker->slug(),
            'website_link' => $this->faker->url(),
            'twitter_link' => 'https://twitter.com/' . $this->faker->slug(),
            'instagram_link' => 'https://instagram.com/' . $this->faker->slug(),
        ];
    }
}
