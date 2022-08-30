<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Circonscription;
use App\Models\HasMany;

class CirconscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Circonscription::class;

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
            'description' => $this->faker->text,
            'nb_secteur' => $this->faker->numberBetween(-10000, 10000),
            'region_id' => HasMany::factory(),
        ];
    }
}
