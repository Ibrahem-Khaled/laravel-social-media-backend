<?php

namespace App\Filament\Widgets;

use App\Models\EntryUser;
use App\Models\FrameUser;
use App\Models\GiftUser;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GiftingWidget extends BaseWidget
{
    protected static ?string $pollingInterval = null;


    protected function getStats(): array
    {
        return [
            Stat::make('Entries' , EntryUser::count())
            ->icon('heroicon-o-document-currency-dollar')
            ->description('Purchase entries by users')
            ->descriptionColor('gray')
            ->chart([rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10)])
            ->color('success'),

            Stat::make('Frames' , FrameUser::count())
            ->icon('heroicon-o-photo')
            ->description('Purchase frames by users')
            ->descriptionColor('gray')
            ->chart([rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10)])
            ->color('primary'),

            Stat::make('Gifts' , GiftUser::count())
            ->icon('heroicon-o-gift')
            ->description('Purchase gifts by users')
            ->descriptionColor('gray')
            ->chart([rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10), rand(1,10)])
            ->color('info'),

        ];
    }

}
