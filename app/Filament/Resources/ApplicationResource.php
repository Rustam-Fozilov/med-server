<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Http\Enums\StatusType;
use App\Models\Application;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $label = "Murojaat";

    protected static ?string $pluralLabel = "Murojaatlar";

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

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
                ->native(false),
                Hidden::make('id'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('user.name')->label('F.I.O'),
                Tables\Columns\TextColumn::make('user.phone')->label('Telefon'),
                Tables\Columns\TextColumn::make('date')->label('Sana'),
                Tables\Columns\TextColumn::make('time')->label('Vaqt'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => StatusType::PENDING->value,
                        'success' => StatusType::APPROVED->value,
                        'danger' => StatusType::REJECTED->value,
                        'gray' => StatusType::COMPLETED->value,
                    ]),
                Tables\Columns\TextColumn::make('created_at')->dateTime('d-m-Y | H:i:s')->label('Yaratilgan sana'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        StatusType::PENDING->value => StatusType::PENDING->value,
                        StatusType::APPROVED->value => StatusType::APPROVED->value,
                        StatusType::REJECTED->value => StatusType::REJECTED->value,
                        StatusType::COMPLETED->value => StatusType::COMPLETED->value,
                    ]),
                Tables\Filters\Filter::make('created_at')
                ->form([
                    DatePicker::make('created_from')->label('Dan'),
                    DatePicker::make('created_until')->label('Gacha'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
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

    public static function getNavigationBadge(): ?string
    {
        $pendingCount = parent::getModel()::query()
            ->where('doctor_id', '=', auth()->user()->doctor->id)
            ->where('status', StatusType::PENDING)
            ->count();

        return $pendingCount === 0 ? null : $pendingCount;
    }
}
