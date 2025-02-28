<?php

namespace App\Filament\App\Resources\OfferPlanResource\Pages;

use App\Filament\App\Resources\OfferPlanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOfferPlan extends EditRecord
{
    protected static string $resource = OfferPlanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
