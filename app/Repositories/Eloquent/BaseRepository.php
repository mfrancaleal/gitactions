<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * Undocumented function
     *
     * @param Model $model
     */
    public function __construct(
        protected Model $model
    ){}

    /**
     * Undocumented function
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Undocumented function
     *
     * @param array $attributes
     * @return Model
     */
    public function update(array $attributes, int $id): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * Undocumented function
     *
     * @return Model
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Undocumented function
     *
     * @return Model
     */
    public function delete($id): int
    {
        return $this->model->destroy($id);
    }
}
