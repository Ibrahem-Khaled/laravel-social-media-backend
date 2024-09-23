<?php

namespace App\Filament\Widgets;

use App\Models\Comments;
use App\Models\Entry;
use App\Models\Frame;
use App\Models\Posts;
use App\Models\Rooms;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverallWidget extends BaseWidget
{

    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
            ->icon('heroicon-o-users')
            ->chart([rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10)])
            ->color('success'),

            Stat::make('Frames', Frame::count())
            ->icon('heroicon-o-photo')
            ->chart([rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10)])
            ->color('primary'),

            Stat::make('Entries' , Entry::count())
            ->icon('heroicon-o-archive-box')
            ->chart([rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10)])
            ->color('info'),

            Stat::make('Rooms', Rooms::count())
            ->icon('heroicon-o-home')
            ->chart([rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10)])
            ->color('danger'),

        ];
    }
}
