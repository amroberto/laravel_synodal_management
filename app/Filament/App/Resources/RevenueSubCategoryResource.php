<?php

namespace App\Filament\App\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Form\Components\Select;
use Filament\Resources\Resource;
use App\Models\RevenueSubCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\App\Resources\RevenueSubCategoryResource\Pages;
use App\Filament\App\Resources\RevenueSubCategoryResource\RelationManagers;

class RevenueSubCategoryResource extends Resource
{
    protected static ?string $model = RevenueSubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('menu.Revenues');
    }

    public static function getModelLabel(): string
    {
        return __('Revenue Sub Categories');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('revenue_category_id')
                    ->label('Categoria de Receita')
                    ->relationship('revenueCategory', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('revenue_category_id')
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('id')->sortable(),
                \Filament\Tables\Columns\TextColumn::make('category.name')->label('Categoria')->sortable()->searchable(),
                \Filament\Tables\Columns\TextColumn::make('name')->label('Nome')->sortable()->searchable(),
                

            ])
            ->filters([
                //
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
            'index' => Pages\ListRevenueSubCategories::route('/'),
            'create' => Pages\CreateRevenueSubCategory::route('/create'),
            'edit' => Pages\EditRevenueSubCategory::route('/{record}/edit'),
        ];
    }
}
