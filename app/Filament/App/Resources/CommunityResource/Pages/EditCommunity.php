<?php

namespace App\Filament\App\Resources\CommunityResource\Pages;

use App\Filament\App\Resources\CommunityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCommunity extends EditRecord
{
    protected static string $resource = CommunityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Obter a comunidade atual
        $community = $this->record;

        if ($community && $community->address) {
            // Atualizar o endereço existente
            $community->address->update([
                'postal_code'    => $data['postal_code'],
                'city_id'        => $data['city_id'],
                'street'         => $data['street'],
                'neighborhood'   => $data['neighborhood'],
                'address_number' => $data['address_number'],
                'complement'     => $data['complement'],
            ]);
        }

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
