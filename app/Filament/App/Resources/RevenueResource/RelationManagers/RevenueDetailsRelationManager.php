<?php

namespace App\Filament\App\Resources\RevenueResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Forms\Components\PtbrMoney;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Livewire\Livewire;

class RevenueDetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'details';

    public function getTableHeading(): string
    {
        return 'Ítens da Receitas';
    }
    protected static ?string $recordTitleAttribute = 'revenue_sub_category_id';
    protected static ?string $title = 'Receitas';
    public static ?string $label = 'Ítem da Receita';
    public static ?string $pluralLabel = 'Ítens da Receita';
    public static ?string $navigationLabel = 'Detalhes da Receita';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('revenue_category_id')
                    ->relationship('category', 'name')
                    ->label('Categoria da Receita')
                    ->default(fn() => $this->ownerRecord->revenue_category_id)
                    ->required()
                    ->dehydrated(false)
                    ->columnSpanFull()
                    ->reactive(),                  
                
                Forms\Components\Select::make('revenue_sub_category_id')
                    ->options(
                        fn (callable $get) => \App\Models\RevenueSubCategory::query()
                            ->where('revenue_category_id', $get('revenue_category_id'))
                            ->pluck('name', 'id')
                    )
                    ->default(fn() => $this->ownerRecord->subcategory->id)
                    ->label('Sub Categoria da Receita')
                    ->columnSpanFull()
                    ->required(),

                PtbrMoney::make('amount')
                    ->label('Valor')
                    ->required(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('revenue_sub_category_id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('category.name')->label( 'Categoria'),
                Tables\Columns\TextColumn::make('subCategory.name')->label('Sub Categoria'),
                Tables\Columns\TextColumn::make('amount')->label('Valor'),
                
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                CreateAction::make()
                    ->after(function () {
                        $this->getOwnerRecord()->updateRevenueTotals();
                        $this->dispatch('refreshParentForm');
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->after(function () {
                        $this->getOwnerRecord()->updateTotals();
                        $this->dispatch('refreshParentForm');
                    }),
                Tables\Actions\DeleteAction::make()
                    ->label('Excluir')
                    ->action(function (array $data) {
                        $this->record->delete();
                        $this->getOwnerRecord()->updateTotals();
                        $this->dispatch('refreshParentForm');
                    })
                    ->requiresConfirmation()
                    ->modalHeading('Excluir Ítem da Receita')
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->action(fn() => $this->record->delete())
                    ->requiresConfirmation()
                    ->modalHeading('Excluir Ítem da Receita'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
