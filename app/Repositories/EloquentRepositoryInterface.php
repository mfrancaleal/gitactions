<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface EloquentRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return Model|null
     */
    // public function find($id): ?Collection;

    /**
     * Undocumented function
     *
     * @param array $attributes
     * @return Model
     */
    public function update(array $attributes, int $id): bool;

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return Model
     */
    public function delete($id): int;

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return Model
     */
    // public function show($id): Model;

    /**
     * Undocumented function
     *
     * @return Model
     */
    public function all(): Collection;
}
