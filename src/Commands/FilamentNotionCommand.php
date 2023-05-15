<?php

namespace LearnKit\FilamentNotion\Commands;

use Illuminate\Console\Command;

class FilamentNotionCommand extends Command
{
    public $signature = 'filament-notion-integration';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
