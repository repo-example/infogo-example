<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @inheritDoc
     */
    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
    public function findBy(string $field, $value)
    {
        return $this->model->where($field, $value)->get();
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Model
    {
        $model = $this->model->newInstance($attributes);
        $model->save();

        return $model->fresh();
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $attributes): Model
    {
        $model = $this->find($id);

        $model->fill($attributes);
        $model->save();

        return $model->fresh();
    }
}
