<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * 根据 ID 查找用户
     *
     * @param int $id
     * @return User|null
     */
    public function byId(int $id): ?User;
}
