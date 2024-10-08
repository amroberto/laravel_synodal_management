<?php

namespace App\Filament\App\Resources\CommunityResource\Pages;

use App\Filament\App\Resources\CommunityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommunities extends ListRecords
{
    protected static string $resource = CommunityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
