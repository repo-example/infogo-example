<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritDoc
     */
    public function byId(int $id): ?User
    {
        return $this->model->whereId($id)->first();
    }
}
