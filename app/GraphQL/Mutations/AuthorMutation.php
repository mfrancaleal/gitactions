<?php

namespace App\GraphQL\Mutations;

use App\Services\AuthorService;

class AuthorMutation
{
    public function __construct(
        private AuthorService $authorService
    ){}

    public function create($root, array $args): array
    {
       return $this->authorService->create($args);
    }

    public function update($root, array $args): array
    {
       return $this->authorService->update($args, $args['id']);
    }

    public function delete($root, array $args): array
    {
        return $this->authorService->delete($args['id']);
    }
}
