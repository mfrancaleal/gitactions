<?php

namespace App\Repositories\Eloquent;

use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class AuthorRepository
 * @package App\Repositories\Eloquent
 */
class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @param Author $model
     */
    public function __construct(Author $model)
    {
        parent::__construct($model);
    }

    /**
     * Undocumented function
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Author::all();
    }


    /**
     * @param string|null $name
     * @param int|null $id
     * @return Collection
     */
    public function find(string $name = null, int $id = null): Collection
    {
        return $this->model::when($name, function ($query) use ($name) {
                $query->where('authors.name', $name);
            })
            ->when($id, function ($query) use ($id) {
            $query->where('users.id', $id);
        })
            ->orderBy('name')
            ->get();
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return Model
     */
    public function show($id): Model
    {
        return parent::find($id);
    }

    /**
     * @param $attributes
     * @return int
     */
    public function store($attributes): Model
    {
        return parent::create($attributes);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function update(array $attributes, int $id): bool
    {
        return parent::update($attributes, $id);
    }

    /**
     * @param int $id
     * @return int
     * @throws \Exception
     */
    public function delete($id): int
    {
        return parent::delete($id);
    }


    /**
     * @param $id
     * @return Model
     */
    public function getUser($id): Model
    {
        return parent::find($id);
    }
}
