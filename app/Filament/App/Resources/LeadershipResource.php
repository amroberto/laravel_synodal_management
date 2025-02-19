<?php

namespace App\Filament\App\Resources;

use Filament\Forms\Set;
use Filament\Forms;
use App\Models\City;
use Filament\Tables;
use App\Models\State;
use App\Models\Address;
use App\Models\Country;
use Filament\Forms\Form;
use App\Models\Community;
use App\Models\Leadership;
use Filament\Tables\Table;
use App\Services\ViaCepService;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\LeadershipResource\Pages;
use App\Filament\App\Resources\LeadershipResource\RelationManagers;
use App\Filament\App\Resources\LeadershipResource\Pages\EditLeadership;
use App\Filament\App\Resources\LeadershipResource\Pages\ListLeaderships;
use App\Filament\App\Resources\LeadershipResource\Pages\CreateLeadership;

class LeadershipResource extends Resource
{
    protected static ?string $model = Leadership::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-circle';

    public static function getNavigationGroup(): ?string
    {
        return __('menu.Registration');
    }

    public static function getModelLabel(): string
    {
        return __('Leaderships');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Informações da Liderança')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome')
                            ->required(),

                        Forms\Components\Select::make('community_id')
                            ->label('Comunidade')
                            ->options(Community::all()->pluck('fantasy_name', 'id'))
                            ->required(),

                        Forms\Components\DatePicker::make('birthdate')
                            ->label('Data de Nascimento')
                            ->required(),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Ativo')
                            ->default(true),

                        Forms\Components\Select::make('gender')
                            ->label('Gênero')
                            ->options([
                                'Male' => 'Masculino',
                                'Female' => 'Feminino',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('mobile')
                            ->label('Celular')
                            ->mask('(99) 99999-9999') // Aplica a máscara diretamente
                            ->tel()
                            ->required(),

                        Forms\Components\TextInput::make('business_phone')
                            ->label('Telefone Comercial')
                            ->mask('(99) 9999-9999') // Aplica a máscara diretamente
                            ->tel(),

                        Forms\Components\TextInput::make('home_phone')
                            ->label('Telefone Residencial')
                            ->mask('(99) 9999-9999') // Aplica a máscara diretamente
                            ->tel(),

                        Forms\Components\TextInput::make('email')
                            ->label('E-mail')
                            ->email(),

                        Forms\Components\FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->rules(['mimes:jpeg,png,jpg,gif,svg'])
                            ->disk('public')
                            ->directory('photos')
                            ->visibility('public'),

                        Forms\Components\Hidden::make('address_id')
                    ])
                    ->columns(2)
                    ->label('Informações da Liderança'),

                Forms\Components\Fieldset::make('Informações de Endereço')
                    ->schema([
                        Forms\Components\TextInput::make('address.postal_code')
                            ->label('CEP')
                            ->mask('99999-999')
                            ->default(fn($record) => $record?->address?->postal_code)
                            ->reactive()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if (!empty($state)) {
                                    $viaCepService = app(ViaCepService::class);
                                    $data = $viaCepService->consultarCep($state);

                                    //dd($data);

                                    if ($data) {
                                        $set('address.street', $data['logradouro'] ?? null);
                                        $set('address.neighborhood', $data['bairro'] ?? null);

                                        $city = City::where('ibge_code', '=', $data['ibge'])->first();

                                        if ($city) {
                                            $set('address.city_id', $city->id);
                                            $set('address.state_id', $city->state_id);
                                            $set('address.country_id', $city->state->country_id);
                                        }
                                    }
                                }
                            }),

                        Forms\Components\Select::make('address.country_id')
                            ->label('Country')
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
                            ->label('State')
                            ->default(fn($record) => $record?->address?->city?->state?->id)
                            ->options(function (callable $get) {
                                $country = $get('address.country_id');
                                if ($country) {
                                    return State::where('country_id', $country)->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->reactive()
                            ->searchable()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $set('address.city_id', null);
                            })
                            ->required(),

                        Forms\Components\Select::make('address.city_id')
                            ->label('City')
                            ->default(fn($record) => $record?->address?->city?->id)
                            ->relationship('address.city', 'name')
                            ->options(function (callable $get) {
                                $state = $get('address.state_id');
                                if ($state) {
                                    return City::where('state_id', $state)->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->reactive()
                            ->searchable()
                            ->required(),

                        Forms\Components\TextInput::make('address.street')
                            ->required()
                            ->label('Rua')
                            ->default(fn($record) => $record?->address?->street),

                        Forms\Components\TextInput::make('address.address_number')
                            ->required()
                            ->label('Número')
                            ->default(fn($record) => $record?->address?->address_number),

                        Forms\Components\TextInput::make('address.complement')
                            ->label('Complemento')
                            ->default(fn($record) => $record?->address?->complement),

                        Forms\Components\TextInput::make('address.neighborhood')
                            ->label('Bairro')
                            ->default(fn($record) => $record?->address?->neighborhood),
                    ])
                    ->columnSpanFull()
                    ->label('Informações de Endereço'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('community.fantasy_name')
                    ->searchable()
                    ->label('Community'),
                Tables\Columns\TextColumn::make('birthdate')
                    ->searchable()    
                    ->label('Data de Nascimento')
                    ->dateTime('d/m/Y'),
                Tables\Columns\TextColumn::make('mobile')
                    ->label('Celular')
                    ->searchable()
                    ->formatStateUsing(fn(string $state): string => formatPhoneNumber($state)),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('E-mail'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListLeaderships::route('/'),
            'create' => Pages\CreateLeadership::route('/create'),
            'edit' => Pages\EditLeadership::route('/{record}/edit'),
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
