<?php

namespace App\Filament\Resources\GiftResource\Pages;

use App\Filament\Resources\GiftResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGift extends CreateRecord
{
    protected static string $resource = GiftResource::class;

    protected static bool $canCreateAnother = false;


    protected function getRedirectUrl(): string
    {
        return route('filament.dashboard.resources.gifts.index');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
