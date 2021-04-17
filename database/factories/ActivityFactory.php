<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

    protected $subjectIcons = [
        'fas fa-truck',
        'fas fa-newspaper',
        'fas fa-image',
        'fas fa-briefcase'
    ];

    protected $subjects = [
        'Convoy #..',
        'Article #..',
        'Picture #..',
        'Recruitment #..'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomNumber = $this->faker->numberBetween(0, 3);

        $creationDateTime = $this->faker->dateTimeBetween('-1 day');

        return [
            'subject_icon' => $this->subjectIcons[$randomNumber],
            'subject' => $this->subjects[$randomNumber],
            'description' => $this->faker->sentence(3),
            'created_at' => $creationDateTime,
            'updated_at' => $creationDateTime
        ];
    }

    public function withoutSubject()
    {
        return $this->state(function (array $attributes) {
            return [
                'subject_icon' => null,
                'subject' => null
            ];
        });
    }
}
