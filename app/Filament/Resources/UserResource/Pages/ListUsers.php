<?php

namespace App\Filament\Resources\UserResource\Pages;

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
            $helper->createAction()
                ->label(__('common.create_user')),
        ];
    }
}
