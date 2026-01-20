<?php

namespace App\Filament\Widgets;

use App\Models\Hardware;
use App\Models\Peripheral;
use App\Models\Provider;
use App\Models\Software;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 6;

    public bool $readyToLoad = false;

    public function loadData(): void
    {
        $this->readyToLoad = true;
    }

    protected function getCards(): array
    {
        if (!$this->readyToLoad) {
            $this->skeletonLoad();
        }

        $hardwares = Hardware::count();
        $softwares = Software::count();
        $providers = Provider::count();
        $peripherals = Peripheral::count();

        // $users = User::where('company_id', auth()->user()->current_company_id)->count();

        return [
            Card::make('Hardware', $hardwares),
            Card::make('Software', $softwares),
            Card::make('Providers', $providers),
            Card::make('Peripherals', $peripherals),

            // Uncomment the following line if you have the 'User' model imported
            // Card::make('Users', $users),
        ];
    }

    protected function skeletonLoad(): array
    {
        return [
            Card::make('Hardware', 'loading...'),
            Card::make('Software', 'loading...'),
            Card::make('Providers', 'loading...'),
            Card::make('Peripherals', 'loading...'),
        ];
    }
}
