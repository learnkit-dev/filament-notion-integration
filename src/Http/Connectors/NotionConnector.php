<?php

namespace LearnKit\FilamentNotion\Http\Connectors;

use Saloon\Http\Connector;

class NotionConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://api.notion.com/v1';
    }

    public function defaultHeaders(): array
    {
        $token = config('filament-notion-integration.notion_secret');

        return [
            'Content-Type' => 'application/json',
            'Notion-Version' => '2022-06-28',
            'Authorization' => "Bearer $token",
        ];
    }
}
