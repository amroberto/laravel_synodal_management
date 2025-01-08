<?php

namespace App\Filament\App\Resources\LeadershipResource\Pages;

use App\Filament\App\Resources\LeadershipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeaderships extends ListRecords
{
    protected static string $resource = LeadershipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
