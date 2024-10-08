<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\CommunityResource\Pages;
use App\Filament\App\Resources\CommunityResource\RelationManagers;
use App\Models\Community;
use App\Models\City;
use App\Services\ViaCepService; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommunityResource extends Resource
{
    protected static ?string $model = Community::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Communities';

    public static function form(Form $form): Form
    {
        return $form
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
                    'point_of_preaching' => 'Point of Preaching',
                    'community' => 'Community',
                    'parish' => 'Parish',
                ])
                ->default('community')
                ->required()
                ->label('Unity Type'),

            Forms\Components\TextInput::make('phone')
                ->label('Phone'),

            Forms\Components\TextInput::make('email')
                ->label('Email'),

            // Relacionamento com Address
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

                Forms\Components\TextInput::make('address.postal_code')
                ->label('Postal Code')
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    // Consultar ViaCepService aqui
                    if (!empty($state)) {
                        $viaCepService = app(ViaCepService::class);
                        $data = $viaCepService->consultarCep($state);
            
                        if ($data) {
                            $set('address.street', $data['logradouro'] ?? '');
                            $set('address.neighborhood', $data['bairro'] ?? '');
                            
                            // Buscar a cidade no banco de dados usando o nome da localidade e o estado (uf)
                            $city = \App\Models\City::where('name', $data['localidade'])
                                                    ->whereHas('state', function ($query) use ($data) {
                                                        $query->where('abbreviation', $data['uf']); // Alterado de 'uf' para 'abbreviation'
                                                    })
                                                    ->first();
            
                            if ($city) {
                                $set('address.city_id', $city->id);
                            }
                        }
                    }
                }),

                Select::make('address.city_id')
                ->options(function (): array {
                    return City::all()->pluck('name', 'id')->all();
                })
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
                // Defina as colunas que você deseja mostrar, como:
                Tables\Columns\TextColumn::make('corporate_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fantasy_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('document'),
                Tables\Columns\TextColumn::make('unity_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->filters([
                // Defina filtros, se necessário
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
}
