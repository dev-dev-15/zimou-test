<?php

namespace App\Filament\Resources\PackageResource\Widgets;

use App\Models\Store;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatisticsWidget extends BaseWidget
{
    // protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total stores', Store::count())
                ->icon('heroicon-m-building-storefront')
                ->description('The total number of stores in the system.'),

            Stat::make('Total packages', \App\Models\Package::count())
                ->icon('heroicon-m-cube')
                ->description('The total number of packages in the system.')
        ];
    }
}
