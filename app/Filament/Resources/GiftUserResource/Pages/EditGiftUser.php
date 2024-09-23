<?php

namespace App\Filament\Resources\GiftUserResource\Pages;

use App\Filament\Resources\GiftUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGiftUser extends EditRecord
{
    protected static string $resource = GiftUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
