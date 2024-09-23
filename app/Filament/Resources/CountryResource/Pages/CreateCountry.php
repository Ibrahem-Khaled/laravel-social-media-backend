<?php

namespace App\Filament\Resources\CountryResource\Pages;

use App\Filament\Resources\CountryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCountry extends CreateRecord
{
    protected static string $resource = CountryResource::class;

    protected static bool $canCreateAnother = false;


    protected function getRedirectUrl(): string
    {
        return route('filament.dashboard.resources.countries.index');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
