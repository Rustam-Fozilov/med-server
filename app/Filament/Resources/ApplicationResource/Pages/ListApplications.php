<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use App\Http\Enums\RoleType;
use App\Models\Application;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListApplications extends ListRecords
{
    protected static string $resource = ApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        if (auth()->user()->hasRole(RoleType::DOCTOR)) {
            return parent::getTableQuery()
                ->whereRelation('doctor', 'user_id', '=', auth()->user()->id)
                ->orderBy('created_at', 'desc')
                ->withoutGlobalScopes();
        }

        return parent::getTableQuery()->limit(5)->withoutGlobalScopes();
    }
}
