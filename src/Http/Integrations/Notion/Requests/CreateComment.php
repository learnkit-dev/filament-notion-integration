<?php

namespace LearnKit\FilamentNotion\Http\Integrations\Notion\Requests;

use LearnKit\FilamentNotion\Http\Connectors\NotionConnector;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\HasConnector;

class CreateComment extends Request implements HasBody
{
    use HasConnector, HasJsonBody;

    public string $connector = NotionConnector::class;

    public Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return '/comments';
    }

    public function __construct(
        public string $pageId,
        public array $objects,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'parent' => [
                'page_id' => $this->pageId,
            ],
            'rich_text' => $this->objects,
        ];
    }
}
