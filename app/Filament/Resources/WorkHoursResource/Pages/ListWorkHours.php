<?php

namespace App\Filament\Resources\WorkHoursResource\Pages;

use App\Filament\Resources\WorkHoursResource;
use App\Http\Enums\RoleType;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListWorkHours extends ListRecords
{
    protected static string $resource = WorkHoursResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->whereRelation('user', 'id', '=', auth()->user()->id)->withoutGlobalScopes();
    }
}
