<?php

namespace OlZyuzin\Reposotories\Interfaces;

use OlZyuzin\Models\Thing;

interface ThingRepositoryInterface
{
    /**
     * @return Thing[]
     */
    public function findAvailable():  array;
}