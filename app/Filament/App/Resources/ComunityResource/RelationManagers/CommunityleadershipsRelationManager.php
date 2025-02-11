<?php

namespace App\Filament\App\Resources\ComunityResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Position;
use Filament\Forms\Form;
use App\Models\Leadership;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\RelationManagers\RelationManager;

class CommunityleadershipsRelationManager extends RelationManager
{
    protected static string $relationship = 'Communityleaderships';

    protected static ?string $title = 'Lideranças da Comunidade';

    public static function getModelLabel(): string
    {
        return __('Community Leaderships');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('leadership_id')
                    ->label('Leadership')
                    ->options(Leadership::query()->pluck('name', 'id')),


                Forms\Components\Select::make('position_id')
                    ->label('Position')
                    ->options(Position::query()->pluck('name', 'id'))
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Lideranças da Comunidade')
            ->pluralModelLabel('Lideranças da Comunidade')
            ->modelLabel('Liderança da Comunidade')
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('leadership.name')->label('Leadership'),
                Tables\Columns\TextColumn::make('position.name')->label('Position'),
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
