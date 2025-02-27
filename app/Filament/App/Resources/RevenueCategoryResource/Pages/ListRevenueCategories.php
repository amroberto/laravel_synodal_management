<?php

namespace App\Filament\App\Resources\RevenueCategoryResource\Pages;

use App\Filament\App\Resources\RevenueCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRevenueCategories extends ListRecords
{
    protected static string $resource = RevenueCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
