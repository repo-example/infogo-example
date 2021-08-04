<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserNameRequest;
use App\Http\Resources\CreateUserResource;
use App\Http\Resources\UserDetailResource;
use App\Services\UserServiceInterface;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * 注册一个用户
     *
     * @param CreateUserRequest $request
     * @return CreateUserResource
     */
    public function register(CreateUserRequest $request)
    {
        $user = $this->userService->create($request);

        return new CreateUserResource($user);
    }

    /**
     * 根据 ID 查找用户
     *
     * @param int $id
     * @return UserDetailResource
     */
    public function byId($id)
    {
        $user = $this->userService->byId($id);

        return new UserDetailResource($user);
    }

    /**
     * 根据ID更新用户名字
     *
     * @param UpdateUserNameRequest $request
     * @param int $id
     * @return array
     */
    public function updateName(UpdateUserNameRequest $request, $id)
    {
        $this->userService->updateName($id, $request);

        return [
            'success' => true,
        ];
    }
}
