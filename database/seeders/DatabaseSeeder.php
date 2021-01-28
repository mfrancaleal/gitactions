<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
           GenreSeeder::class
        ]);
        User::factory(10)->create();
        Author::factory(10)->create();
        Post::factory(10)->create();
        Comment::factory(80)->create();
    }
}
