<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Filament\Resources\ApplicationResource\RelationManagers;
use App\Http\Enums\StatusType;
use App\Models\Application;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $label = "Ariza";

    protected static ?string $pluralLabel = "Arizalar";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->label('Status')
                    ->options([
                        StatusType::PENDING->value => StatusType::PENDING->value,
                        StatusType::APPROVED->value => StatusType::APPROVED->value,
                        StatusType::REJECTED->value => StatusType::REJECTED->value,
                        StatusType::COMPLETED->value => StatusType::COMPLETED->value,
                    ])
                    ->required()
                ->native(false)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('user.name')->label('Name'),
                Tables\Columns\TextColumn::make('user.phone')->label('Phone'),
                Tables\Columns\TextColumn::make('time'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => StatusType::PENDING->value,
                        'success' => StatusType::APPROVED->value,
                        'danger' => StatusType::REJECTED->value,
                        'gray' => StatusType::COMPLETED->value,
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d-m-Y | H:i:s'),
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
            ])->defaultSort('created_at');
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}
