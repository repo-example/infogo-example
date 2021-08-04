<?php

namespace App\Services;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserNameRequest;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * 根据 ID 查找用户
     *
     * @param id $id
     * @return User
     */
    public function byId($id): User;

    /**
     * 保存用户
     *
     * @param CreateUserRequest $request
     * @return User
     */
    public function create(CreateUserRequest $request): User;

    /**
     * 更新用户 Name
     *
     * @param int $id
     * @param UpdateUserNameRequest $request
     * @return int
     */
    public function updateName(int $id, UpdateUserNameRequest $request): int;
}
