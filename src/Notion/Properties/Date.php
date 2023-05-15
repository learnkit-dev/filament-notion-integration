<?php

namespace LearnKit\FilamentNotion\Notion\Properties;

class Date extends Property
{
    public static ?string $type = 'date';

    public function fill(array $config): mixed
    {
        return '';
    }

    public function setUp(): void
    {

        if (! filled($this->plainValue)) {
            return;
        }

        if (is_array($this->plainValue)) {
            $this->value = [
                'start' => (string) $this->plainValue[0] ?? null,
                'end' => (string) $this->plainValue[1] ?? null,
            ];

            return;
        }

        $this->value = [
            'start' => (string) $this->plainValue,
        ];
    }

    public function get(): array
    {
        return [
            ...($this->value ?? [$this->value]),
            'time_zone' => 'Europe/Amsterdam',
        ];
    }
}
