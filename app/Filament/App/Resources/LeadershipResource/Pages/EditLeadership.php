<?php

namespace App\Filament\App\Resources\LeadershipResource\Pages;

use App\Models\Leadership;
use Filament\Resources\Pages\EditRecord;
use App\Filament\App\Resources\LeadershipResource;

class EditLeadership extends EditRecord
{
    protected static string $resource = LeadershipResource::class;

    // Corrige a assinatura do método mount para aceitar o parâmetro correto
    public function mount(string|int $record): void
    {
        // Certifique-se de passar o record para a classe pai
        parent::mount($record);
    }
    
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Se a comunidade tiver um endereço existente, ele é atualizado
        if ($this->record->address) {
            $this->record->address->update([
                'postal_code' => $data['address']['postal_code'],
                'city_id' => $data['address']['city_id'],
                'street' => $data['address']['street'],
                'neighborhood' => $data['address']['neighborhood'],
                'address_number' => $data['address']['address_number'],
                'complement' => $data['address']['complement'] ?? null,
            ]);
        }

        // Remove os dados do endereço do array que vai salvar a comunidade, porque já atualizamos o endereço
        unset($data['address']);

        return $data;
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Carregar os relacionamentos necessários
        $data['leathership'] = Leadership::with('address.city.state.country')->find($data['id']);
        
        // Preenche os dados do endereço da comunidade no formulário
        if ($this->record->address) {
            $data['address'] = [
                'postal_code' => $this->record->address->postal_code,
                'state_id' => $this->record->address->city->state->id,
                'country_id' => $this->record->address->city->state->country->id,
                'city_id' => $this->record->address->city_id,
                'street' => $this->record->address->street,
                'neighborhood' => $this->record->address->neighborhood,
                'address_number' => $this->record->address->address_number,
                'complement' => $this->record->address->complement,
            ];
        }

        return $data;
    }
}
