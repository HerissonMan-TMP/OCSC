<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order' => $this->faker->randomDigit(),
            'name' => $this->faker->word(),
            'icon_name' => $this->faker->word(),
            'color' => $this->faker->hexColor(),
            'contrast_color' => $this->faker->hexColor(),
            'description' => $this->faker->sentence(),
            'recruitment_enabled' => $this->faker->boolean(),
        ];
    }
}
