<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserService
{
    protected $userRepositoryInterface;

    public function __construct(
        UserRepositoryInterface $userRepositoryInterface
    ){
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function findUser($id): ?User
    {
        return $this->userRepositoryInterface->find($id);
    }

    public function createUser(array $data): User
    {
        return $this->userRepositoryInterface->create($data);
    }

    public function updateUser(User $user, array $data): User
    {
        return $this->userRepositoryInterface->update($user, $data);
    }

    public function deleteUser(User $user): void
    {
        $this->userRepositoryInterface->delete($user);
    }
}
