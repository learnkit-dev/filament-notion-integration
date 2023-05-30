<?php

namespace LearnKit\FilamentNotion\Http\Integrations\Notion\Requests;

use LearnKit\FilamentNotion\Http\Connectors\NotionConnector;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\HasConnector;

class RetrievePage extends Request
{
    use HasConnector;

    public string $connector = NotionConnector::class;

    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/pages/'.$this->pageId;
    }

    public function __construct(
        protected string $pageId,
    ) {
    }
}
