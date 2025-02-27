<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\RevenueCategoryResource\Pages;
use App\Filament\App\Resources\RevenueCategoryResource\RelationManagers;
use App\Models\RevenueCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RevenueCategoryResource extends Resource
{
    protected static ?string $model = RevenueCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('menu.Registration');
    }

    public static function getModelLabel(): string
    {
        return __('Revenue Categories');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            'index' => Pages\ListRevenueCategories::route('/'),
            'create' => Pages\CreateRevenueCategory::route('/create'),
            'edit' => Pages\EditRevenueCategory::route('/{record}/edit'),
        ];
    }
}
