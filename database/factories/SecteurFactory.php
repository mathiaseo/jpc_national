<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Secteur;

class SecteurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Secteur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'city' => $this->faker->city,
            'content' => $this->faker->paragraphs(3, true),
            'nb_localite' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
