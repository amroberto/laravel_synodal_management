<?php

namespace App\Filament\App\Resources;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\OfferPlan;
use Filament\Tables\Table;
use App\Enums\OfferTypeEnum;
use Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Forms\FormsComponent;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\OfferPlanResource\Pages;
use App\Filament\App\Resources\OfferPlanResource\RelationManagers;

class OfferPlanResource extends Resource
{
    protected static ?string $model = OfferPlan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('menu.Offers');
    }

    public static function getModelLabel(): string
    {
        return __('Offer Plans');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                forms\Components\DatePicker::make('offer_date')
                    ->label('Offer Date')
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if ($state) {
                            $date = Carbon::parse($state);
                            $set('month', $date->format('m'));
                            $set('year', $date->format('Y'));
                        }
                    }),

                forms\Components\TextInput::make('liturgical_date')
                    ->label('Liturgical Date')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('destination')
                    ->required(),

                Forms\Components\Select::make('offer_type')
                    ->label('Offer Type')
                    ->options([
                        OfferTypeEnum::LOCAL->value => 'Local',
                        OfferTypeEnum::SINODAL->value => 'Sínodal',
                        OfferTypeEnum::NACIONAL->value => 'Nacional',
                        OfferTypeEnum::ESPECIAL->value => 'Especial',
                    ]),

                Forms\Components\Hidden::make('month'),
                Forms\Components\Hidden::make('year'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('offer_date', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('mes_abreviado')
                    ->label('Month')
                    ->sortable(),
                Tables\Columns\TextColumn::make('offer_date')
                    ->label('Day')
                    ->date('d')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('liturgical_date')
                    ->label('Liturgical Date')
                    ->searchable(),
                Tables\Columns\TextColumn::make('offer_type')
                    ->label('Instance')
                    ->searchable()
                    ->badge(),
                Tables\Columns\TextColumn::make('destination')
                    ->label('Destination')
                    ->searchable(),

            ])
            ->filters([
                SelectFilter::make('month')
                    ->label('Filtrar por Mês')
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
                SelectFilter::make('offer_type')
                    ->label('Tipo de Instância')
                    ->options([
                        OfferTypeEnum::LOCAL->value => 'Local',
                        OfferTypeEnum::SINODAL->value => 'Sínodal',
                        OfferTypeEnum::NACIONAL->value => 'Nacional',
                        OfferTypeEnum::ESPECIAL->value => 'Especial',
                    ]),
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
            'index' => Pages\ListOfferPlans::route('/'),
            'create' => Pages\CreateOfferPlan::route('/create'),
            'edit' => Pages\EditOfferPlan::route('/{record}/edit'),
        ];
    }
}
