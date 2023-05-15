<?php

namespace LearnKit\FilamentNotion\Http\Integrations\Notion\Requests;

use LearnKit\FilamentNotion\Http\Connectors\NotionConnector;
use LearnKit\FilamentNotion\Http\Objects\NotionPageObject;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;
use Saloon\Traits\Request\HasConnector;

class UpdatePage extends Request implements HasBody
{
    use HasConnector, HasJsonBody;

    public string $connector = NotionConnector::class;

    /**
     * Define the HTTP method
     *
     * @var Method
     */
    protected Method $method = Method::PATCH;

    /**
     * Define the endpoint for the request
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/pages/' . $this->page->id;
    }

    public function __construct(
        protected NotionPageObject $page,
    ) {}

    protected function defaultBody(): array
    {
        ray($this->page->toNotionFormat());

        return $this->page->toNotionFormat();
    }
}
