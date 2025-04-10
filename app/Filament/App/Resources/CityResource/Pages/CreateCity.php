<?php

namespace App\Filament\App\Resources\CityResource\Pages;
use App\Models\City;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\App\Resources\CityResource;

class CreateCity extends CreateRecord
{
    protected static string $resource = CityResource::class;
}
