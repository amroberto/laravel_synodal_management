<?php

namespace App\Filament\App\Resources\RevenueResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\OfferPlan;
use App\Filament\Forms\Components\PtbrMoney;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Notification;
use Illuminate\Support\Carbon;

class OffersRelationManager extends RelationManager
{
    protected static string $relationship = 'offers';

        public function getTableHeading(): string
    {
        return 'Ítens da Oferta';
    }
    protected static ?string $title = 'Ofertas';
    public static ?string $label = 'Ítem da Oferta';
    public static ?string $pluralLabel = 'Ítens da ferta';
    public static ?string $navigationLabel = 'Detalhes da Oferta';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('dt_offer')
                    ->label('Data da Oferta')
                    ->debounce(1000)
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $plan = OfferPlan::whereDate('offer_date', $state)->first();

                        $date = Carbon::parse($state);

                        $set('month', $date->month);
                        $set('year', $date->year);

                        if ($plan) {
                            $set('offer_plan_id', $plan->id);
                            $set('destination', $plan->destination);
                        } else {
                            $set('offer_plan_id', null);
                            $set('destination', 'Plano não encontrado');

                            Notification::make()
                                ->title('Plano de oferta não encontrado')
                                ->body('Nenhum destinatário de oferta foi encontrado para a data selecionada. Verifique o plano de ofertas cadastrado.')
                                ->danger()
                                ->persistent()
                                ->send();
                        }
                    }),

                Forms\Components\Hidden::make('offer_plan_id'),

                Forms\Components\TextInput::make('destination')
                    ->label('Destino da Oferta')
                    ->disabled()
                    ->columnSpanFull()
                    ->dehydrated(false),

                PtbrMoney::make(name: 'value')
                    ->label('Valor')
                    ->default(0.0)
                    ->required(),

                Forms\Components\Hidden::make('month'),

                Forms\Components\Hidden::make('year'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('offer_plan_id')
            ->columns([
                Tables\Columns\TextColumn::make('dt_offer')
                    ->label('Data')
                    ->date('d/m/Y'),

                Tables\Columns\TextColumn::make('offerPlan.destination')
                    ->label('Destino')
                    ->wrap(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->money('BRL'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
