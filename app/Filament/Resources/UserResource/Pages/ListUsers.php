<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            Tab::make('All')
                ->badge(User::query()->count())
                ->badgeColor('success')
                ->icon('heroicon-o-users'),
            Tab::make('Active')
                ->badge(User::query()->where('status', true)->count())
                ->badgeColor('success')
                ->icon('heroicon-o-check-circle')
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', true);
                }),
            Tab::make('Inactive')
                ->badge(User::query()->where('status', false)->count())
                ->badgeColor('danger')
                ->icon('heroicon-o-exclamation-circle')
                ->modifyQueryUsing(function ($query) {
                    $query->where('status', false);
                }),
        ];
    }
}
