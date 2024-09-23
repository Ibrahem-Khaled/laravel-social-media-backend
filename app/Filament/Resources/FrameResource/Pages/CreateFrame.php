<?php

namespace App\Filament\Resources\FrameResource\Pages;

use App\Filament\Resources\FrameResource;
use App\Traits\UploadImage;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CreateFrame extends CreateRecord
{
    use UploadImage;

    protected static string $resource = FrameResource::class;

    protected static bool $canCreateAnother = false;


    protected function getRedirectUrl(): string
    {
        return route('filament.dashboard.resources.frames.index');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function beforeSave(array $data): array
    {
        $request = app(Request::class);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data['image'] = $this->uploadImage($image, 'images/avatars');
        }

        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        $data = $this->beforeSave($data);
        return parent::handleRecordCreation($data);
    }
}
