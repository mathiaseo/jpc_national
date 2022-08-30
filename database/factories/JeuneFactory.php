<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Jeune;
use App\Models\Localite;

class JeuneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jeune::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'city' => $this->faker->city,
            'fonction' => $this->faker->randomElement(["Jeune","President","Secretaire","Vice-president","Tresorier","Animateur","Conseiller"]),
            'is_married' => $this->faker->boolean,
            'is_water_baptism' => $this->faker->boolean,
            'is_spirit_baptism' => $this->faker->boolean,
            'birthday' => $this->faker->date(),
            'date_water_baptism' => $this->faker->date(),
            'date_spirit_baptism' => $this->faker->date(),
            'sexe' => $this->faker->randomElement(["Masculin","Feminin"]),
            'localite_id' => Localite::factory(),
        ];
    }
}
