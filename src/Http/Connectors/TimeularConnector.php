<?php

namespace LearnKit\FilamentNotion\Http\Connectors;

use Saloon\Http\Connector;

class TimeularConnector extends Connector
{
    public function resolveBaseUrl(): string
    {
        return 'https://api.timeular.com/api/v3';
    }

    public function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
        ];
    }
}
