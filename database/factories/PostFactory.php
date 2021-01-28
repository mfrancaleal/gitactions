<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Genre;
use App\Models\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => $this->faker->realText(30),
            'year' => $this->faker->year('now'),
            'text' => $this->faker->realText(),
            'author_id' => Author::inRandomOrder()->limit(1)->value('id'),
            'genre_id' => Genre::select('id')->inRandomOrder()->limit(1)->value('id'),
        ];
    }
}
