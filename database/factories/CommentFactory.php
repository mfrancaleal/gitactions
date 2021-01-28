<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => Author::inRandomOrder()->limit(1)->value('id'),
            'post_id' => Post::inRandomOrder()->limit(1)->value('id'),
            'commentary' => $this->faker->realText()
        ];
    }
}
