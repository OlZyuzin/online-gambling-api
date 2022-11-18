<?php

namespace OlZyuzin\Reposotories;

use OlZyuzin\Models\Thing;

interface ThingRepositoryInterface
{
    /**
     * @return Thing[]
     */
    public function findAvailable():  array;
}