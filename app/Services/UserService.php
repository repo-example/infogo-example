<?php

namespace App\Services;

use App\Events\UserCreated;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserNameRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private UserRepositoryInterface $userRepository;

    /**
     * @var Hasher
     */
    private Hasher $hasher;

    /**
     * UserService constructor
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository, Hasher $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
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
            'password' => $this->hasher->make($request->password),
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
