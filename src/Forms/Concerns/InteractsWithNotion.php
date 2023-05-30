<?php

namespace LearnKit\FilamentNotion\Forms\Concerns;

use Filament\Actions\Action;
use LearnKit\FilamentNotion\Forms\Notion;
use LearnKit\FilamentNotion\Http\Integrations\Notion\Requests\RetrieveDatabase;
use LearnKit\FilamentNotion\Http\Objects\NotionPageObject;

trait InteractsWithNotion
{
    protected static ?string $notionDatabaseId = null;

    public function mount()
    {
        $this->form->fill([]);
    }

    public function submitToNotion()
    {
        $data = $this->form->getState();

        $notion = $this
            ->getNotion(new Notion())
            ->getNotionPageObject($data)
            ->createPage();

        return $this->afterFormSubmittedToNotion($notion);
    }

    public function submitToNotionAction(): Action
    {
        return Action::make('submit_to_notion_action')
            ->label(static::getSubmitToNotionActionLabel())
            ->action('submitToNotion')
            ->color('green');
    }

    public static function getSubmitToNotionActionLabel(): string
    {
        return 'Submit';
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

    protected function getNotionDatabaseProperties(): array
    {
        $request = new RetrieveDatabase(
            databaseId: $this->getNotionDatabaseId()
        );

        $response = $request->send()->json();

        return $response['properties'] ?? [];
    }

    protected function getNotionPageObject(array $data): NotionPageObject
    {
        $properties = $this->getNotionDatabaseProperties();

        $object = NotionPageObject::make();

        foreach ($this->getFormSchema() as $component) {
            if (! isset($properties[$component->getName()])) {
                continue;
            }

            $property = $properties[$component->getName()];

            $object->setProperty($property['name'], $property['type'], $data[$property['name']]);
        }

        return $object;
    }

    public function getNotion(Notion $notion): Notion
    {
        return $notion;
    }

    public function getDefaultNotionProperties(): array
    {
        return [];
    }

    public function afterFormSubmittedToNotion(Notion $notion)
    {
    }
}
