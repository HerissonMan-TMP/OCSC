<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactMessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactMessage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'truckersmp_id' => $this->faker->numberBetween(0, 4999999),
            'vtc' => $this->faker->word(),
            'discord' => $this->faker->word() . '#' . $this->faker->numberBetween(0, 9999),
            'email' => $this->faker->safeEmail(),
            'message' => $this->faker->text(500),
            'status' => 'unread',
        ];
    }

    /**
     * Indicate that the contact message's status should be "read".
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function statusRead()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'read',
            ];
        });
    }

    /**
     * Indicate that the contact message sender didn't mention a VTC.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withoutVtc()
    {
        return $this->state(function (array $attributes) {
            return [
                'vtc' => null,
            ];
        });
    }

    /**
     * Indicate that the contact message sender didn't mention a Discord username.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withoutDiscord()
    {
        return $this->state(function (array $attributes) {
            return [
                'discord' => null,
            ];
        });
    }

    /**
     * Indicate that the contact message sender didn't mention an email.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withoutEmail()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => null,
            ];
        });
    }
}
