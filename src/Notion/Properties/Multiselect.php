<?php

namespace LearnKit\FilamentNotion\Notion\Properties;

class Multiselect extends Property
{
    public static ?string $type = 'multi_select';

    public function get(): array
    {
        return collect($this->value ?? [])
            ->map(fn ($value) => ['name' => $value])
            ->toArray();
    }
}
