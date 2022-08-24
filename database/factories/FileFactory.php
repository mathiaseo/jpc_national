<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\File;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'path' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'rooth_path' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'type' => $this->faker->regexify('[A-Za-z0-9]{400}'),
        ];
    }
}
