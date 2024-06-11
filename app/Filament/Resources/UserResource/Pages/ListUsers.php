<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Exports\UserExporter;
use App\Filament\Imports\UserImporter;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return __('common.users');
    }

    public function table(Table $table): Table
    {
        $helper = filamentTableHelper();
        $action = filamentTableActionHelper();

        return $table
            ->columns([
                $helper->text('email')
                    ->label(__('common.email')),
                $helper->text('name')
                    ->label(__('common.name')),
                $helper->icon('is_active')
                    ->label(__('common.active'))
                    ->alignCenter()
                    ->boolean(),
                $helper->deleted(),
            ])
            ->actions([
                $action->editAction(),
            ]);
    }

    protected function getHeaderActions(): array
    {
        $helper = filamentActionHelper();

        return [
            $helper->importAction(UserImporter::class)
                ->label(__('common.import_users'))
                ->pluralModelLabel(__('common.+users')),
            $helper->exportAction(UserExporter::class)
                ->label(__('common.export_users'))
                ->pluralModelLabel(__('common.+users')),
            $helper->createAction()
                ->label(__('common.create_user')),
        ];
    }
}
