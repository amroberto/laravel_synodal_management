<?php

namespace App\Filament\App\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use App\Models\Revenue;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tables\Columns\TextColumn;
use Filament\Resources\Resource;
use App\Models\RevenueSubCategory;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Forms\Components\PtbrMoney;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\RevenueResource\Pages;
use App\Models\OfferPlan;

class RevenueResource extends Resource
{
    protected static ?string $model = Revenue::class;

    public static ?string $navigationGroup = 'Financeiro';

    public static ?string $navigationLabel = 'Receitas';

    public static function getModelLabel(): string
    {
        return 'Receita';
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Fieldset::make('Detalhes da Receita')
                    ->schema([
                        Forms\Components\DatePicker::make('dt_revenue')
                            ->label('Data do Lançamento')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Set $set, $state) {
                                if ($state) {
                                    $date = Carbon::parse($state);
                                    $set('month', (int) $date->format('m'));
                                    $set('year', (int) $date->format('Y'));
                                }
                            }),

                        Forms\Components\Select::make('community_id')
                            ->label('Comunidade')
                            ->relationship('community', 'fantasy_name')
                            ->columnSpan(4)
                            ->required(),

                        Forms\Components\Select::make('reference_month')
                            ->label('Mês Referência')
                            ->options(
                                [
                                    1 => 'Janeiro',
                                    2 => 'Fevereiro',
                                    3 => 'Março',
                                    4 => 'Abril',
                                    5 => 'Maio',
                                    6 => 'Junho',
                                    7 => 'Julho',
                                    8 => 'Agosto',
                                    9 => 'Setembro',
                                    10 => 'Outubro',
                                    11 => 'Novembro',
                                    12 => 'Dezembro'
                                ]
                            )
                            ->columnSpan(1)
                            ->required(),

                        Forms\Components\TextInput::make('reference_year')
                            ->label('Ano Referência')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->default(now()->year)
                            ->columnSpan(1)
                            ->required(),

                        PtbrMoney::make('total_revenue')
                            ->label('Total Receitas')
                            ->default(0.0)
                            ->disabled()
                            ->columnSpan(1),

                        PtbrMoney::make('tithe')
                            ->label('Dízimo (10%)')
                            ->default(0.0)
                            ->disabled()
                            ->required()
                            ->columnSpan(1),

                        PtbrMoney::make('offers')
                            ->label('Ofertas a Repassar')
                            ->default(0.0)
                            ->disabled()
                            ->required()
                            ->columnSpan(1),

                        Forms\Components\Hidden::make('month'),

                        Forms\Components\Hidden::make('year'),

                        Forms\Components\Hidden::make('user_id')
                            ->default(fn() => Auth::id()),
                    ])
                    ->columns(5),

                Forms\Components\Fieldset::make('details')
                    ->schema([
                        Forms\Components\Repeater::make('details')
                            ->relationship()
                            ->schema([
                                Forms\Components\Select::make('revenue_category_id')
                                    ->relationship('category', 'name')
                                    ->label('Categoria da Receita')
                                    ->dehydrated(false)
                                    ->columnSpan(2)
                                    ->reactive(),

                                Forms\Components\Select::make('revenue_sub_category_id')
                                    ->options(
                                        fn(callable $get) => RevenueSubCategory::query()
                                            ->where('revenue_category_id', $get('revenue_category_id'))
                                            ->pluck('name', 'id')
                                    )
                                    ->label('Sub Categoria da Receita')
                                    ->columnSpan(2)
                                    ->distinct()
                                    ->required(),

                                PtbrMoney::make('amount')
                                    ->label('Valor')
                                    ->default(0.0)
                                    ->columnSpan(1)
                                    ->required(),
                            ])
                            ->columns(5)
                            ->columnSpanFull()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set) {
                                $items = $get('details');

                                $total = collect($items)
                                    ->pluck('amount')
                                    ->filter()
                                    ->map(function ($value) {
                                        // Remove pontos e troca vírgula por ponto
                                        $cleaned = str_replace(['.', ','], ['', '.'], $value);
                                        return floatval($cleaned);
                                    })
                                    ->sum();

                                $formattedTotal = number_format($total, 2, ',', '.');
                                $formattedTithe = number_format($total * 0.10, 2, ',', '.');

                                $set('total_revenue', $formattedTotal);
                                $set('tithe', $formattedTithe);
                            }),
                    ])
                    ->columns(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference_month')
                    ->label('Ref. Mês')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn($state) => match ($state) {
                        1 => 'JAN',
                        2 => 'FEV',
                        3 => 'MAR',
                        4 => 'ABR',
                        5 => 'MAI',
                        6 => 'JUN',
                        7 => 'JUL',
                        8 => 'AGO',
                        9 => 'SET',
                        10 => 'OUT',
                        11 => 'NOV',
                        12 => 'DEZ'
                    }),

                Tables\Columns\TextColumn::make('reference_year')
                    ->label('Ref. Ano')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('community.fantasy_name')
                    ->label('Comunidade')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_revenue')
                    ->label('Total Receitas')
                    ->money('BRL')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tithe')
                    ->label('Dizimo (10%)')
                    ->money('BRL')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_offers')
                    ->label('Ofertas a Repassar')
                    ->money('BRL')
                    ->sortable()
                    ->searchable(),

            ])
            ->filters([
                SelectFilter::make('reference_month')
                    ->label('Filtrar por Mês Referência')
                    ->options([
                        1 => 'JAN',
                        2 => 'FEV',
                        3 => 'MAR',
                        4 => 'ABR',
                        5 => 'MAI',
                        6 => 'JUN',
                        7 => 'JUL',
                        8 => 'AGO',
                        9 => 'SET',
                        10 => 'OUT',
                        11 => 'NOV',
                        12 => 'DEZ',
                    ]),
                SelectFilter::make('community_id')
                    ->label('Filtrar por Comunidade')
                    ->relationship('community', 'fantasy_name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->options(
                        function (Builder $query) {
                            return $query->pluck('fantasy_name', 'id');
                        }
                    ),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListRevenues::route('/'),
            'create' => Pages\CreateRevenue::route('/create'),
            'edit' => Pages\EditRevenue::route('/{record}/edit'),
        ];
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;

        $date = Carbon::parse($data['dt_revenue']);

        $data['month'] = (int) $date->format('m');
        $data['year'] = (int) $date->format('Y');

        return $data;
    }
}
