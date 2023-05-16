<?php

namespace LearnKit\FilamentNotion\Http\Objects;

class RichTextObject
{
    public function __construct(
        public string $content = '',
        public string $type = 'text',
        public bool $bold = false,
        public bool $italic = false,
        public bool $underline = false,
    ) {}

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'text' => [
                'content' => $this->content,
                'link' => null,
            ],
            'annotations' => [
                'bold' => $this->bold,
                'italic' => $this->italic,
                'strikethrough' => false,
                'underline' => $this->underline,
                'code' => false,
                'color' => 'default',
            ],
            'plain_text' => $this->content,
            'href' => null,
        ];
    }
}
