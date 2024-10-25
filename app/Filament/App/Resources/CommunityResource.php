<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\City;
use App\Models\Address;
use App\Models\Community;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Enums\UnityTypeEnum;
use Forms\Components\Select;
use App\Services\ViaCepService;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use App\Filament\App\Resources\CommunityResource\Pages;

class CommunityResource extends Resource
{
    protected static ?string $model = Community::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('menu.Registration');
    }

    public static function getModelLabel(): string
    {
        return __('Community');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Community Information')
                    ->schema([
                        Forms\Components\TextInput::make('corporate_name')
                            ->required()
                            ->label('Corporate Name'),

                        Forms\Components\TextInput::make('fantasy_name')
                            ->label('Fantasy Name'),

                        Forms\Components\TextInput::make('document')
                            ->required()
                            ->label('Document'),

                        Forms\Components\Select::make('unity_type')
                            ->options([
                                UnityTypeEnum::PreachingPoint->value => 'Preaching Point',
                                UnityTypeEnum::Community->value => 'Community',
                                UnityTypeEnum::Parish->value => 'Parish',
                            ])
                            ->default(UnityTypeEnum::Community->value)
                            ->required()
                            ->label('Unity Type'),

                        Forms\Components\TextInput::make('phone')
                            ->label('Phone'),

                        Forms\Components\TextInput::make('email')
                            ->label('Email'),

                        Forms\Components\Hidden::make('address_id'),
                    ])
                    ->columns(2)
                    ->label('Community Information'),

                Forms\Components\Fieldset::make('Address Information')
                    ->schema([
                        Forms\Components\TextInput::make('postal_code')
                            ->label('Postal Code')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (!empty($state)) {
                                    // Consultar ViaCepService aqui
                                    $viaCepService = app(ViaCepService::class);
                                    $data = $viaCepService->consultarCep($state);
                                    
                                    if ($data) {
                                        // Definir os valores retornados pelo ViaCep
                                        $set('street', $data['logradouro'] ?? null);
                                        $set('neighborhood', $data['bairro'] ?? null);

                                        // Buscar cidade na tabela `city` com base no nome retornado pelo ViaCep
                                        $city = City::where('name', $data['localidade'])
                                                ->whereHas('state', function ($query) use ($data) {
                                                    $query->where('abbreviation', $data['uf']); // Fazendo a busca pela UF
                                                })
                                                ->first();

                                        // Se a cidade foi encontrada, definir o city_id
                                        if ($city) {
                                            $set('city_id', $city->id);
                                        }
                                    }
                                }
                            }),

                        Forms\Components\TextInput::make('street')
                            ->required()
                            ->label('Street'),

                        Forms\Components\TextInput::make('address_number')
                            ->required()
                            ->label('Number'),

                        Forms\Components\TextInput::make('complement')
                            ->label('Complement'),

                        Forms\Components\TextInput::make('neighborhood')
                            ->label('Neighborhood'),

                        Forms\Components\Select::make('city_id')
                            ->label('Select City')
                            ->options(City::all()->pluck('name', 'id'))
                            ->required(),

                    ])
                    ->columns(2)
                    ->label('Address Information'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('corporate_name')->label('Corporate Name'),
                Tables\Columns\TextColumn::make('fantasy_name')->label('Fantasy Name'),
                Tables\Columns\TextColumn::make('document')->label('Document'),
                Tables\Columns\TextColumn::make('phone')->label('Phone'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
                Tables\Columns\TextColumn::make('address.city.name')->label('City'),
            ])
            ->filters([
                // Filtros opcionais, caso necessário
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListCommunities::route('/'),
            'create' => Pages\CreateCommunity::route('/create'),
            'edit'   => Pages\EditCommunity::route('/{record}/edit'),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Verifica se o endereço existe, se não, cria um novo
        if (!isset($data['address_id'])) {
            $address = Address::create([
                'postal_code' => $data['address']['postal_code'],
                'city_id' => $data['address']['city_id'],
                'street' => $data['address']['street'],
                'neighborhood' => $data['address']['neighborhood'],
                'address_number' => $data['address']['address_number'],
                'complement' => $data['address']['complement'],
            ]);
            // Associa o ID do endereço criado ao registro de `Community`
            $data['address_id'] = $address->id;
        } else {
            // Atualiza o endereço existente
            $address = Address::find($data['address_id']);
            $address->update([
                'postal_code' => $data['address']['postal_code'],
                'city_id' => $data['address']['city_id'],
                'street' => $data['address']['street'],
                'neighborhood' => $data['address']['neighborhood'],
                'address_number' => $data['address']['address_number'],
                'complement' => $data['address']['complement'],
            ]);
        }

        // Remove os dados de endereço do array principal, para evitar problemas
        unset($data['address']);

        return $data;
    }
}