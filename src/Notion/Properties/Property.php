<?php

namespace LearnKit\FilamentNotion\Notion\Properties;

class Property
{
    public static ?string $type = null;

    public function __construct(
        public ?string $name = null,
        public mixed $plainValue = null,
        public mixed $value = null,
    ) {
        $this->hydrate();
    }

    public function update($value): void
    {
        $this->plainValue = $value;
        $this->hydrate();
    }

    protected function hydrate(): void
    {
        if (is_array($this->plainValue) && filled($this->plainValue['id'] ?? null)) {
            $this->plainValue = $this->fill($this->plainValue);
        }

        $this->setUp();
    }

    public function fill(array $config): mixed
    {
        return $config[$config['type']];
    }

    public function setUp(): void
    {
        $this->value = $this->plainValue;
    }

    public function formatForRequest(): array
    {
        $label = $this->name;
        $type = $this::$type;

        $value = $this->get();

        return [
            $label => [
                $type => $value,
            ],
        ];
    }

    public function get(): mixed
    {
        return [
            [
                static::$type => [
                    'content' => $this->value,
                ],
            ],
        ];
    }

    public static function make(string $name, string $type, mixed $value)
    {
        return match ($type) {
            'title' => new Title($name, $value),
            'date' => new Date($name, $value),
            'checkbox' => new Checkbox($name, $value),
            'multi_select' => new Multiselect($name, $value),
            'people' => new People($name, $value),
            default => new Text($name, $value),
        };
    }
}
