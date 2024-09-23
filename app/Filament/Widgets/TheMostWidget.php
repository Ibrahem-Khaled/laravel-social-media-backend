<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TheMostWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Most Followed User', User::orderBy('followers', 'desc')->first()->name)
                ->description('Followers: ' . User::orderBy('followers', 'desc')->first()->followers)
                ->icon('heroicon-o-chat-bubble-bottom-center-text')
                ->color('success'),
        ];
    }
}
