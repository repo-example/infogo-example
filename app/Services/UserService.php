<?php

namespace App\Services;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserNameRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * UserService constructor
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository  = $userRepository;
    }

    /**
     * @inheritdoc
     */
    public function byId($id): User
    {
        return $this->userRepository->find($id);
    }

    /**
     * @inheritdoc
     */
    public function create(CreateUserRequest $request): User
    {
        $token = Str::random(64);

        $user = $this->userRepository->create([
            'username' => $request->username,
            'password' => $request->password,
            'api_token' => $token
        ]);

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function updateName(int $id, UpdateUserNameRequest $request): int
    {
        $user = $this->userRepository->byId($id);

        $this->userRepository->update($id, [
            'name' => $request->name
        ]);

        return $user->id;
    }
}
