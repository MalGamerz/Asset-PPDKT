<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static string $view = 'filament.resources.user-resource.widgets.user-overview';

    public $readyToLoad = false;

    public function loadData(): void
    {
        $this->readyToLoad = true;

        $this->userCount = User::count();
    }

    protected function getCards(): array
    {
        $cards = [];

        if (!$this->readyToLoad) {
            $cards = $this->skeletonLoad();
        } else {
            $cards[] = Card::make('Total Users', $this->userCount);
        }

        return $cards;
    }

    protected function skeletonLoad(): array
    {
        return [
            Card::make('Loading data...')->description('')
        ];
    }
}
