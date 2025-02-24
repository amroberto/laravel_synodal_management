<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\State;
use App\Models\Address;
use App\Models\Country;
use App\Models\Position;
use Filament\Forms\Form;
use App\Models\Community;
use App\Models\Leadership;
use Filament\Tables\Table;
use App\Enums\UnityTypeEnum;
use App\Services\ViaCepService;
use Filament\Resources\Resource;
use App\Filament\App\Resources\CommunityResource\Pages;
use App\Filament\App\Resources\ComunityResource\RelationManagers\CommunityleadershipsRelationManager;
use App\Filament\App\Resources\ComunityResource\RelationManagers\LeadershipsRelationManager as RelationManagersLeadershipsRelationManager;
use Filament\Resources\Pages\ContentTabPosition;

class CommunityResource extends Resource
{
    protected static ?string $model = Community::class;

    protected static ?string $navigationIcon = 'heroicon-s-users';

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
                Forms\Components\Fieldset::make('Informações da Comunidade')
                    ->schema([
                        Forms\Components\TextInput::make('corporate_name')
                            ->required()
                            ->label('Razão Social'),

                        Forms\Components\TextInput::make('fantasy_name')
                            ->label('Nome Fantasia'),

                        Forms\Components\TextInput::make('document')
                            ->label('CNPJ')
                            ->required()
                            ->mask('99.999.999/9999-99')
                            ->rule('cnpj')
                            ->afterStateUpdated(function ($state, callable $set) {
                                // Remove todos os caracteres não numéricos
                                $numericCNPJ = preg_replace('/\D/', '', $state);
                                $set('cnpj', $numericCNPJ);
                            }),

                        Forms\Components\Select::make('unity_type')
                            ->options([
                                UnityTypeEnum::PreachingPoint->value => 'Ponto de Pregação',
                                UnityTypeEnum::Community->value => 'Comunidade',
                                UnityTypeEnum::Parish->value => 'Paróquia',
                            ])
                            ->default(UnityTypeEnum::Community->value)
                            ->required()
                            ->label('Tipo de Unidade'),

                        Forms\Components\TextInput::make('phone')
                            ->label('Telefone')
                            ->mask('(99) 9999-9999') // Aplica a máscara diretamente
                            ->tel(),

                        Forms\Components\TextInput::make('mobile')
                            ->label('Celular')
                            ->mask('(99) 99999-9999') // Aplica a máscara diretamente
                            ->tel(),

                        Forms\Components\TextInput::make('email')
                            ->label('E-mail'),

                        Forms\Components\Hidden::make('address_id')
                    ])
                    ->columns(2)
                    ->label('Informações da Comunidade'),

                Forms\Components\Fieldset::make('Informações de Endereço')
                    ->schema([
                        Forms\Components\TextInput::make('address.postal_code')
                            ->label('CEP')
                            ->mask('99999-999')
                            ->default(fn($record) => $record?->address?->postal_code)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (!empty($state)) {
                                    $viaCepService = app(ViaCepService::class);
                                    $data = $viaCepService->consultarCep($state);

                                    if ($data) {
                                        $set('address.street', $data['logradouro'] ?? null);
                                        $set('address.neighborhood', $data['bairro'] ?? null);

                                        $city = City::where('name', $data['localidade'])
                                            ->whereHas('state', function ($query) use ($data) {
                                                $query->where('abbreviation', $data['uf']);
                                            })
                                            ->first();

                                        if ($city) {
                                            $set('address.city_id', $city->id);
                                            $set('address.state_id', $city->state->id);
                                            $set('address.country_id', $city->state->country->id);
                                        }
                                    }
                                }
                            }),

                        Forms\Components\Select::make('address.country_id')
                            ->label('País')
                            ->default(fn($record) => $record?->address?->city?->state?->country?->id)
                            ->options(Country::all()->pluck('name', 'id')->toArray())
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('address.state_id', null);
                                $set('address.city_id', null);
                            })
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('address.state_id')
                            ->label('Estado')
                            ->default(fn($record) => $record?->address?->city?->state?->id)
                            ->options(function (callable $get) {
                                $country = $get('address.country_id');
                                if ($country) {
                                    return State::where('country_id', $country)->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->default(fn($record) => $record?->address?->city?->state?->id)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('address.city_id', null);
                            })
                            ->searchable()
                            ->required(),

                        Forms\Components\Select::make('address.city_id')
                            ->label('City')
                            ->default(fn($record) => $record?->address?->city?->id) 
                            ->options(function (callable $get) {
                                $state = $get('address.state_id');
                                if ($state) {
                                    return City::where('state_id', $state)->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->searchable()
                            ->required(),

                        Forms\Components\TextInput::make('address.street')
                            ->required()
                            ->label('Street')
                            ->default(fn($record) => $record?->address?->street),

                        Forms\Components\TextInput::make('address.address_number')
                            ->required()
                            ->label('Number')
                            ->default(fn($record) => $record?->address?->address_number),

                        Forms\Components\TextInput::make('address.complement')
                            ->label('Complement')
                            ->default(fn($record) => $record?->address?->complement),

                        Forms\Components\TextInput::make('address.neighborhood')
                            ->label('Neighborhood')
                            ->default(fn($record) => $record?->address?->neighborhood),
                    ])
                    ->columns(2)
                    ->label('Endereço'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('corporate_name')->label('Corporate Name')->searchable(),
                Tables\Columns\TextColumn::make('fantasy_name')->label('Fantasy Name')->searchable(),
                Tables\Columns\TextColumn::make('document')->label('Document')->searchable(),
                Tables\Columns\TextColumn::make('mobile')->label('Mobile')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('Phone')->searchable(),
                Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
                Tables\Columns\TextColumn::make('address.city.name')->label('City')->searchable(),
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
            //RelationManagersLeadershipsRelationManager::class,
            CommunityleadershipsRelationManager::class,
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
                'city_id' => $data['address']['city']['id'],
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
