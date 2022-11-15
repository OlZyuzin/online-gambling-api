<?php

namespace OlZyuzin\Reposotories;

use OlZyuzin\Models\User;

interface UserRepositoryInterface
{
    public function findUser(int $id): ?User;
}