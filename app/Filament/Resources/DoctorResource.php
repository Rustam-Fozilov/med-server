<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $label = 'Doktor';

    protected static ?string $pluralLabel = "Doktorlar";

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\Section::make([
//                        Forms\Components\TextInput::make('user.name')->label('Name')->required(),
//                        Forms\Components\TextInput::make('user.phone')->label('Phone')->required(),
                        Forms\Components\TextInput::make('user_id'),
                        Forms\Components\TextInput::make('specialization')->label('Mutaxassisligi')->required(),
                        Forms\Components\TextInput::make('experience')->label('experience'),
                        Forms\Components\TextInput::make('birth_year')->numeric()->label("Tug'ilgan sana"),
                    ])
                ]),
                Forms\Components\Group::make([
                    Forms\Components\Section::make([
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
                    ])
                ])->label('fds')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('user.name')->label('F.I.O'),
                Tables\Columns\TextColumn::make('user.phone')->label('Telefon'),
                Tables\Columns\TextColumn::make('specialization')->label('Mutaxassisligi'),
                Tables\Columns\TextColumn::make('experience')->label('Tajribasi'),
                Tables\Columns\TextColumn::make('birth_year')->label("Tug'ilgan sana"),
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
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}
