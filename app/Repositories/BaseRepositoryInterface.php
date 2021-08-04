<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    /**
     * 查询所有结果
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * 根据主键查询单个结果
     *
     * @param int $id
     * @return Model|null
     */
    public function find($id): ?Model;

    /**
     * 根据某个字段查询结果
     *
     * @param string $field
     * @param string $value
     * @return mixed
     */
    public function findBy(string $field, $value);

    /**
     * 分页查询
     *
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator;

    /**
     * 保存模型
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * 更新模型
     *
     * @param int $id
     * @param array $attributes
     * @return Model
     */
    public function update($id, array $attributes): Model;
}
