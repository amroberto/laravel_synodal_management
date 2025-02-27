<?php

namespace App\Filament\App\Resources\RevenueSubCategoryResource\Pages;

use App\Filament\App\Resources\RevenueSubCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRevenueSubCategories extends ListRecords
{
    protected static string $resource = RevenueSubCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
