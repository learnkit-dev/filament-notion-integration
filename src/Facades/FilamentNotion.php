<?php

namespace LearnKit\FilamentNotion\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \LearnKit\FilamentNotion\FilamentNotion
 */
class FilamentNotion extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LearnKit\FilamentNotion\FilamentNotion::class;
    }
}
