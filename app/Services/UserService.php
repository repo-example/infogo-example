<?php

namespace App\Services;

use App\Events\UserCreated;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserNameRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UserService constructor
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritdoc
     */
    public function all(): LengthAwarePaginator
    {
        return $this->userRepository->paginate();
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
            'name' => $request->name,
            'api_token' => $token
        ]);

        event(new UserCreated($user));

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
