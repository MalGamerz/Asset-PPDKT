<?php

namespace App\Filament\Resources\SoftwareResource\Pages;

use App\Filament\Resources\SoftwareResource;
use Exception;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoftware extends ListRecords
{
    protected static string $resource = SoftwareResource::class;

    /**
     * @throws Exception
     */
    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
