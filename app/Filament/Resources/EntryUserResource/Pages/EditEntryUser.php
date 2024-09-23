<?php

namespace App\Filament\Resources\EntryUserResource\Pages;

use App\Filament\Resources\EntryUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEntryUser extends EditRecord
{
    protected static string $resource = EntryUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
