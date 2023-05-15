<?php

namespace LearnKit\FilamentNotion\Http\Integrations\Notion\Requests;

use LearnKit\FilamentNotion\Http\Connectors\NotionConnector;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\HasConnector;

class QueryDatabase extends Request implements HasBody
{
    use HasConnector, HasJsonBody;

    public string $connector = NotionConnector::class;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/databases/'.$this->databaseId.'/query';
    }

    public function __construct(
        public string $databaseId,
        public array $filters = [],
    ) {
    }

    protected function defaultBody(): array
    {
        return [
            'filter' => [
                'or' => [
                    ...$this->filters,
                ],
            ],
        ];
    }

    public function addFilter(string $property, string $propertyType, string $filterType, mixed $value): static
    {
        $this->filters[] = [
            'property' => $property,
            $propertyType => [
                $filterType => $value,
            ],
        ];

        return $this;
    }
}
