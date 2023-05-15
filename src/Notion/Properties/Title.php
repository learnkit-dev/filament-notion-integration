<?php

namespace LearnKit\FilamentNotion\Notion\Properties;

class Title extends Text
{
    public static ?string $type = 'title';

    public function get(): array
    {
        return [
            [
                'type' => 'text',
                'text' => [
                    'content' => $this->value,
                ],
            ],
        ];
    }
}
