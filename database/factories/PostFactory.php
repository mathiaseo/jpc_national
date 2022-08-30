<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ImageGallery;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'content' => $this->faker->paragraphs(3, true),
            'video_link' => $this->faker->regexify('[A-Za-z0-9]{400}'),
            'image_gallery_id' => ImageGallery::factory(),
            'published_at' => $this->faker->dateTime(),
            'type' => $this->faker->randomElement(["article","temoignage","evenement"]),
            'views' => $this->faker->numberBetween(-10000, 10000),
            'like' => $this->faker->numberBetween(-10000, 10000),
            'favorite' => $this->faker->numberBetween(-10000, 10000),
            'autor' => User::factory(),
        ];
    }
}
