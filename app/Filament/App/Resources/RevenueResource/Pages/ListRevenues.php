<?php

namespace App\Filament\App\Resources\RevenueResource\Pages;

use App\Filament\App\Resources\RevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRevenues extends ListRecords
{
    protected static string $resource = RevenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
