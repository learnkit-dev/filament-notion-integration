<?php

namespace LearnKit\FilamentNotion\Notion\Properties;

class People extends Property
{
    public static ?string $type = 'people';

    public function get(): array
    {
        return [
            [
                'object' => 'user',
                'id' => $this->value,
            ],
        ];
    }
}
