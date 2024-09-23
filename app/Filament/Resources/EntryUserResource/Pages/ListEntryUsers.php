<?php

namespace App\Filament\Resources\EntryUserResource\Pages;

use App\Filament\Resources\EntryUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEntryUsers extends ListRecords
{
    protected static string $resource = EntryUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
