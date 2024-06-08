<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions\CreateAction;
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
            ])
            ->actions([
                $helper->editAction(),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('common.create_user')),
        ];
    }
}
