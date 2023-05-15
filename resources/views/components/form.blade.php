<x-filament::form wire:submit.prevent="submit">
    {{ $slot }}

    {{ $this->submitToNotionAction }}
</x-filament::form>
