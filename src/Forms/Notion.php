<?php

namespace LearnKit\FilamentNotion\Forms;

use LearnKit\FilamentNotion\Http\Integrations\Notion\Requests\CreatePage;
use LearnKit\FilamentNotion\Http\Integrations\Notion\Requests\RetrieveDatabase;
use LearnKit\FilamentNotion\Http\Objects\NotionPageObject;

class Notion
{
    public mixed $response = null;

    protected ?string $databaseId = null;

    protected ?NotionPageObject $pageObject = null;

    protected array $defaultProperties = [];

    protected array $properties = [];

    public function databaseId(string $databaseId): static
    {
        $this->databaseId = $databaseId;

        return $this;
    }

    public function pageObject(NotionPageObject $pageObject): static
    {
        $this->pageObject = $pageObject;

        return $this;
    }

    public function defaultProperties(array $properties): static
    {
        $this->defaultProperties = $properties;

        return $this;
    }

    public function createPage(): static
    {
        foreach ($this->defaultProperties as $key => $value) {
            $notionProperty = $this->properties[$key];

            $this->pageObject->setProperty($key, $notionProperty['type'], $value);
        }

        $request = new CreatePage(
            databaseId: $this->databaseId,
            page: $this->pageObject,
        );

        $this->response = $request->send()->json();

        return $this;
    }

    public function getNotionPageObject(array $data): static
    {
        $this->properties = $this->getNotionDatabaseProperties();

        $this->pageObject = NotionPageObject::make();

        foreach ($data as $key => $value) {
            if (! isset($this->properties[$key])) {
                continue;
            }

            $property = $this->properties[$key];

            $this->pageObject->setProperty($property['name'], $property['type'], $value);
        }

        return $this;
    }

    protected function getNotionDatabaseProperties(): array
    {
        $request = new RetrieveDatabase(
            databaseId: $this->databaseId,
        );

        $response = $request->send()->json();

        return $response['properties'] ?? [];
    }
}
