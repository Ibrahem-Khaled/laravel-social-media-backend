<?php

namespace App\Filament\Resources\GiftUserResource\Pages;

use App\Filament\Resources\GiftUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGiftUsers extends ListRecords
{
    protected static string $resource = GiftUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
