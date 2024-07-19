<?php

namespace App\Filament\Resources\DoctorRelationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorsRelationManager extends RelationManager
{
    protected static string $relationship = 'doctors';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TimePicker::make('work_start_time')
                    ->seconds(false)
                    ->prefix('Dan')
                    ->format('H:i')
                    ->label('Ish soati(dan)')
                    ->required(),
                Forms\Components\TimePicker::make('work_end_time')
                    ->seconds(false)
                    ->prefix('Gacha')
                    ->format('H:i')
                    ->label('Ish soati(gacha)')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Ish soati')
            ->columns([
                Tables\Columns\TextColumn::make('work_start_time')->label('Ish soati(dan)'),
                Tables\Columns\TextColumn::make('work_end_time')->label('Ish soati(gacha)'),
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
