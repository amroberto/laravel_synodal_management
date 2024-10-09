<?php

namespace App\Filament\App\Resources\CommunityResource\Pages;

use Filament\Actions;
use App\Models\Address;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\App\Resources\CommunityResource;

class CreateCommunity extends CreateRecord
{
    protected static string $resource = CommunityResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Criar o endereço na tabela de addresses
        $address = Address::create([
            'postal_code'      => $data['postal_code'],
            'city_id'          => $data['city_id'],
            'street'           => $data['street'],
            'neighborhood'     => $data['neighborhood'],
            'address_number'   => $data['address_number'],
            'complement'       => $data['complement'],
        ]);

        // Associar o address_id à comunidade
        $data['address_id'] = $address->id;

        // Remover os campos de endereço do array de dados para não tentar salvar na tabela `communities`
        unset(
            $data['postal_code'],
            $data['city_id'],
            $data['street'],
            $data['neighborhood'],
            $data['address_number'],
            $data['complement']
        );

        return $data;
    }
}
