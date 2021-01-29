<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface AuthorRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @return Collection
     */
    public function all(): Collection;

    public function create(array $request): Model;

    public function update(array $request, int $id): bool;

    public function delete($id): int;

    public function find(?string $name, ?int $id): Collection;

}
