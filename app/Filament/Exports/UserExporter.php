<?php

namespace App\Filament\Exports;

use App\Models\User;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UserExporter extends Exporter
{
    protected static ?string $model = User::class;

    public static function getColumns(): array
    {
        $helper = filamentExportHelper();

        return [
            $helper->column('uuid')
                ->label('UUID')
                ->enabledByDefault(false),
            $helper->column('is_active')
                ->label(__('common.active'))
                ->formatStateUsing(fn (int $state) => $state ? __('common.yes') : __('common.no')),
            $helper->column('email')
                ->label(__('common.email')),
            $helper->column('name')
                ->label(__('common.name')),
            $helper->column('created_at')
                ->label(__('common.created_at')),
            $helper->column('updated_at')
                ->label(__('common.updated_at')),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your user export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
