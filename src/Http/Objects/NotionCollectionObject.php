<?php

namespace LearnKit\FilamentNotion\Http\Objects;

use Illuminate\Support\Collection;

class NotionCollectionObject extends Collection
{
    public static function fromResponse($response): static
    {
        $results = $response->json('results');

        return new static(
            items: array_map(fn ($item) => NotionPageObject::fromNotionFormat($item), $results),
        );
    }
}
