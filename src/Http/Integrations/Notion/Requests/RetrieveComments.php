<?php

namespace LearnKit\FilamentNotion\Http\Integrations\Notion\Requests;

use LearnKit\FilamentNotion\Http\Connectors\NotionConnector;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Request\HasConnector;

class RetrieveComments extends Request
{
    use HasConnector;

    public string $connector = NotionConnector::class;

    public Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/comments?block_id='.$this->blockId;
    }

    public function __construct(
        public string $blockId
    ) {
    }
}
