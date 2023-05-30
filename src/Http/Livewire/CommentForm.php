<?php

namespace LearnKit\FilamentNotion\Http\Livewire;

use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Contracts\HasForms;
use LearnKit\FilamentNotion\Http\Integrations\Notion\Requests\CreateComment;
use LearnKit\FilamentNotion\Http\Objects\RichTextObject;
use Livewire\Component;

class CommentForm extends Component implements HasForms, HasActions
{
    use InteractsWithActions;

    public ?string $pageId = null;

    public function mount()
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Textarea::make('comment'),
        ];
    }

    public function submitCommentAction(): Action
    {
        return Action::make('submit_comment_action')
            ->label('Submit')
            ->color('grey')
            ->action('submit');
    }

    public function submit()
    {
        $data = $this->form->getState();

        $objects = [
            (new RichTextObject(
                content: $data['comment'],
            ))->toArray()
        ];

        $request = new CreateComment(
            pageId: $this->pageId,
            objects: $objects,
        );

        $response = $request->send()->json();

        $this->form->fill(null);
    }

    public function render()
    {
        return view('filament-notion::livewire.comment-form');
    }
}
