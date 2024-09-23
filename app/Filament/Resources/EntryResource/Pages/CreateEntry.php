<?php

namespace App\Filament\Resources\EntryResource\Pages;

use App\Filament\Resources\EntryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEntry extends CreateRecord
{
    protected static string $resource = EntryResource::class;

    protected static bool $canCreateAnother = false;


    protected function getRedirectUrl(): string
    {
        return route('filament.dashboard.resources.entries.index');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
