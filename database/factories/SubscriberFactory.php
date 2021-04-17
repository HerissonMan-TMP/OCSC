<?php

namespace Database\Factories;

use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

class SubscriberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscriber::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $email = $this->faker->safeEmail();

        return [
            'email' => $email,
            'unsubscribe_token' => Crypt::encryptString($email)
        ];
    }
}
