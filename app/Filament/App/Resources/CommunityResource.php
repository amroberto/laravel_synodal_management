<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\Address;
use Filament\Forms\Form;
use App\Models\Community;
use Filament\Tables\Table;
use App\Enums\UnityTypeEnum;
use Forms\Components\Select;
use App\Services\ViaCepService; 
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\CommunityResource\Pages;
use App\Filament\App\Resources\CommunityResource\RelationManagers;
use App\Filament\App\Resources\CommunityResource\Pages\EditCommunity;
use App\Filament\App\Resources\CommunityResource\Pages\CreateCommunity;
use App\Filament\App\Resources\CommunityResource\Pages\ListCommunities;

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
                    ])
                    ->columns(2)
                    ->label('Community Information'),

                Forms\Components\Fieldset::make('Address Information')
                    ->schema([
                        Forms\Components\TextInput::make('address.postal_code')
                            ->label('Postal Code')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if (!empty($state)) {
                                    // Consultar ViaCepService aqui
                                    $viaCepService = app(ViaCepService::class);
                                    $data = $viaCepService->consultarCep($state);
                                    
                                    if ($data) {
                                        // Definir os valores retornados pelo ViaCep
                                        $set('address.street', $data['logradouro'] ?? null);
                                        $set('address.neighborhood', $data['bairro'] ?? null);

                                        // Buscar cidade na tabela `city` com base no nome retornado pelo ViaCep
                                        $city = \App\Models\City::where('name', $data['localidade'])
                                                ->whereHas('state', function ($query) use ($data) {
                                                    $query->where('abbreviation', $data['uf']); // Fazendo a busca pela UF
                                                })
                                                ->first();

                                        // Se a cidade foi encontrada, definir o city_id
                                        if ($city) {
                                            $set('address.city_id', $city->id);
                                        }
                                    }
                                }
                            }),

                        Forms\Components\TextInput::make('address.street')
                            ->required()
                            ->label('Street'),

                        Forms\Components\TextInput::make('address.address_number')
                            ->required()
                            ->label('Number'),

                        Forms\Components\TextInput::make('address.complement')
                            ->label('Complement'),

                        Forms\Components\TextInput::make('address.neighborhood')
                            ->label('Neighborhood'),

                        Forms\Components\Select::make('address.city_id')
                            ->relationship('address.city', 'name')
                            ->required()
                            ->label('City'),
                    ])
                    ->columns(2)
                    ->label('Address Information'),
            ]);  
    }

    /**
     * @param Table $table
     * 
     * @return Table
     */
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

    /**
     * @return array
     */
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    /**
     * @return array
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCommunities::route('/'),
            'create' => Pages\CreateCommunity::route('/create'),
            'edit' => Pages\EditCommunity::route('/{record}/edit'),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Criar endereço e associar à comunidade
        $address = Address::create([
            'postal_code' => $data['address']['postal_code'],
            'city_id' => $data['address']['city_id'],
            'street' => $data['address']['street'],
            'neighborhood' => $data['address']['neighborhood'],
        ]);

        // Associar endereço criado à comunidade
        $data['address_id'] = $address->id;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Atualizar endereço existente
        $community = Community::find($this->record->id);

        if ($community && $community->address) {
            $community->address->update([
                'postal_code' => $data['address']['postal_code'],
                'city_id' => $data['address']['city_id'],
                'street' => $data['address']['street'],
                'neighborhood' => $data['address']['neighborhood'],
            ]);
        }

        return $data;
    }
}
