<?php

namespace LearnKit\FilamentNotion\Notion\Properties;

class Checkbox extends Property
{
    public static ?string $type = 'checkbox';

    public function get(): mixed
    {
        return $this->value;
    }
}
