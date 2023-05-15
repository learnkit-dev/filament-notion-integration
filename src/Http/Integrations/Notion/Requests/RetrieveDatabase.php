<?php

namespace LearnKit\FilamentNotion\Http\Integrations\Notion\Requests;

use LearnKit\FilamentNotion\Http\Connectors\NotionConnector;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\HasConnector;

class RetrieveDatabase extends Request
{
    use HasConnector;

    public string $connector = NotionConnector::class;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/databases/' . $this->databaseId;
    }

    public function __construct(
        public string $databaseId
    ) {}
}
