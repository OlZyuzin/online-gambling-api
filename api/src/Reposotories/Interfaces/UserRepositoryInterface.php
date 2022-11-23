<?php

namespace OlZyuzin\Reposotories\Interfaces;

use OlZyuzin\Models\User;

interface UserRepositoryInterface
{
    public function findUser(int $id): ?User;
}