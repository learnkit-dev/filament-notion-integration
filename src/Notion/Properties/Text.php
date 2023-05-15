<?php

namespace LearnKit\FilamentNotion\Notion\Properties;

class Text extends Property
{
    public static ?string $type = 'rich_text';

    public function fill(array $config): mixed
    {
        if (! filled($config[static::$type] ?? null)) {
            return null;
        }

        if (is_array($config[static::$type])) {
            return implode(' ', array_map(fn ($text) => $text['plain_text'], $config[static::$type]));
        }

        return '';
    }

    public function get(): array
    {
        return [
            [
                'text' => [
                    'content' => $this->value,
                ],
            ],
        ];
    }
}
