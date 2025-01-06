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
        // Verificar se o endereço existe no array 'address'
        if (isset($data['address']) && !empty($data['address'])) {
            // Criar o endereço na tabela de addresses com os dados do array 'address'
            $address = Address::create([
                'postal_code'      => $data['address']['postal_code'],
                'city_id'          => $data['address']['city_id'],
                'street'           => $data['address']['street'],
                'neighborhood'     => $data['address']['neighborhood'],
                'address_number'   => $data['address']['address_number'],
                'complement'       => $data['address']['complement'],
            ]);

            // Associar o address_id à comunidade
            $data['address_id'] = $address->id;

            // Remover os campos de endereço do array de dados para não tentar salvar na tabela `communities`
            unset(
                $data['address'], // Remover o campo 'address' completamente
                $data['address']['postal_code'],
                $data['address']['city_id'],
                $data['address']['street'],
                $data['address']['neighborhood'],
                $data['address']['address_number'],
                $data['address']['complement']
            );
        }

        // Retornar os dados, agora com o address_id no lugar de 'address'
        return $data;
    }
}
