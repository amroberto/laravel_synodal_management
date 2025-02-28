<?php

namespace App\Filament\App\Resources\OfferPlanResource\Pages;

use App\Filament\App\Resources\OfferPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOfferPlans extends ListRecords
{
    protected static string $resource = OfferPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
