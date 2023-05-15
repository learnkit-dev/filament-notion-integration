<?php

namespace LearnKit\FilamentNotion\Http\Objects;

use LearnKit\FilamentNotion\Notion\Properties\Property;

class NotionPageObject
{
    public function __construct(
        protected ?string $id = null,
        protected ?string $title = null,
        protected ?string $icon = null,
        protected ?string $cover = null,
        public array $properties = [],
    ) {
        $this->setProperty('Name', 'title', $this->title);
    }

    public function setProperty(string $name, string $type, mixed $value = null): static
    {
        $propertyName = \Str::of($name)->lower()->snake()->toString();

        $this->properties[$propertyName] = Property::make(
            name: $name,
            type: $type,
            value: $value,
        );

        return $this;
    }

    protected function updateProperty(string $name, mixed $value): void
    {
        $property = $this->properties[$name];

        $property->update($value);
    }

    public function toNotionFormat(): array
    {
        $output = [];

        if (filled($this->icon)) {
            $output['icon'] = [
                'emoji' => $this->icon,
            ];
        }

        if (filled($this->cover)) {
            $output['cover'] = [
                'external' => [
                    'url' => $this->cover,
                ],
            ];
        }

        $properties = collect($this->properties)
            ->filter(function (Property $property) {
                if ($property->value === null) {
                    return false;
                }

                return true;
            })
            ->flatMap(function (Property $property) {
                return $property->formatForRequest();
            })
            ->toArray();

        return [
            ...$output,
            'properties' => [
                ...$properties,
            ],
        ];
    }

    public static function fromNotionFormat(array $data): static
    {
        $page = new static(
            id: $data['id'],
        );

        foreach ($data['properties'] as $propertyName => $propertyConfig) {
            $page->setProperty(
                name: $propertyName,
                type: $propertyConfig['type'],
                value: $propertyConfig,
            );
        }

        return $page;
    }

    public static function make(...$args): static
    {
        return new static(...$args);
    }

    public function __get(string $name)
    {
        if ($name === 'id') {
            return $this->id;
        }

        return $this->properties[$name]->value;
    }

    public function __set(string $name, $value): void
    {
        $this->updateProperty($name, $value);
    }

    public function __isset(string $name): bool
    {
        return isset($this->properties[$name]);
    }
}
