<?php

namespace LearnKit\FilamentNotion\Forms\Concerns;

use Filament\Actions\Action;
use LearnKit\FilamentNotion\Http\Integrations\Notion\Requests\CreatePage;
use LearnKit\FilamentNotion\Http\Integrations\Notion\Requests\RetrieveDatabase;
use LearnKit\FilamentNotion\Http\Objects\NotionPageObject;

trait InteractsWithNotion
{
    protected static ?string $notionDatabaseId = null;

    public function submitToNotion(): void
    {
        $data = $this->form->getState();

        //
        $object = new NotionPageObject(
            title: 'Hello world!'
        );

        // Get schema from the Notion database
        $request = new RetrieveDatabase(
            databaseId: $this->getNotionDatabaseId()
        );

        $response = $request->send()->json();

        $properties = $response['properties'];

        foreach ($this->getFormSchema() as $component) {
            if (! isset($properties[$component->getName()])) {
                continue;
            }

            $property = $response['properties'][$component->getName()];

            $object->setProperty($property['name'], $property['type'], $data[$property['name']]);
        }

        // Create a new Notion page in the database
        $request = new CreatePage(
            databaseId: $this->getNotionDatabaseId(),
            page: $object
        );

        $response = $request->send()->json();

        ray($response);
    }

    public function submitToNotionAction(): Action
    {
        return Action::make('submit_to_notion_action')
            ->label('Submit')
            ->action('submitToNotion')
            ->color('green');
    }

    public function notionDatabaseId(?string $databaseId): static
    {
        static::$notionDatabaseId = $databaseId;

        return $this;
    }

    public function getNotionDatabaseId(): ?string
    {
        return static::$notionDatabaseId;
    }
}
