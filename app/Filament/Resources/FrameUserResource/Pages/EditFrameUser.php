<?php

namespace App\Filament\Resources\FrameUserResource\Pages;

use App\Filament\Resources\FrameUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFrameUser extends EditRecord
{
    protected static string $resource = FrameUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
