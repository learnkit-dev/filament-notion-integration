<?php

namespace LearnKit\FilamentNotion\Http\Integrations\Notion\Requests;

use LearnKit\FilamentNotion\Http\Connectors\NotionConnector;
use LearnKit\FilamentNotion\Http\Objects\NotionPageObject;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\HasConnector;

class CreatePage extends Request implements HasBody
{
    use HasConnector, HasJsonBody;

    public string $connector = NotionConnector::class;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/pages';
    }

    public function __construct(
        public string $databaseId,
        public NotionPageObject $page,
    ) {
    }

    protected function defaultBody(): array
    {
        return [
            'parent' => [
                'database_id' => $this->databaseId,
            ],
            ...$this->page->toNotionFormat(),
        ];
    }
}
