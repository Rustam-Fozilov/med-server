<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkHoursResource\Pages;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkHoursResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $label = 'Ish soati';

    protected static ?string $pluralLabel = 'Ish soati';

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('work_start_time')->label('Ish soati(dan)'),
                Tables\Columns\TextColumn::make('work_end_time')->label('Ish soati(gacha)'),
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
            'index' => Pages\ListWorkHours::route('/'),
            'create' => Pages\CreateWorkHours::route('/create'),
            'edit' => Pages\EditWorkHours::route('/{record}/edit'),
        ];
    }
}
