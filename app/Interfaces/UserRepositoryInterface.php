<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function find($id): ?User;
    public function create(array $data): User;
    public function update(User $user, array $data): User;
    public function delete(User $user): void;
}
