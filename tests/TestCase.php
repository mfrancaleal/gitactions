<?php

namespace Tests;

use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Nuwave\Lighthouse\Testing\MakesGraphQLRequests;
use Illuminate\Database\Eloquent\Factories\Factory;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use MakesGraphQLRequests;

    public function testQueriesAuthors(): void
    {
        $user = Factory::factoryForModel(User::class)->create();
        $author = Factory::factoryForModel(Author::class)->create();
        $this->actingAs($user, 'sanctum')->graphQL(/** @lang GraphQL */ '{
            authors{
                id
                name
                nationality
            }
        }
        ')
            ->assertStatus(200)
            ->assertJsonFragment([
                [
                    'id' => (string) $author->id,
                    'name' => $author->name,
                    'nationality' => $author->nationality,
                ]
            ]);
    }
}
