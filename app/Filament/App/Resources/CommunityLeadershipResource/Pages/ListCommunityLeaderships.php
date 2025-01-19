<?php

namespace App\Filament\App\Resources\CommunityLeadershipResource\Pages;

use App\Filament\App\Resources\CommunityLeadershipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCommunityLeaderships extends ListRecords
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
