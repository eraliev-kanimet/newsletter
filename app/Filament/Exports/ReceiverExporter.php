<?php

namespace App\Filament\Exports;

use App\Models\Receiver;

class ReceiverExporter extends BaseExporter
{
    protected static ?string $model = Receiver::class;

    public static function getColumns(): array
    {
        $helper = filamentExportHelper();

        return [
            $helper->columnTernary('is_active')
                ->label(__('common.active')),
            $helper->column('user.name')
                ->label(__('common.author')),
            $helper->column('email')
                ->label(__('common.email')),
            $helper->column('created_at')
                ->label(__('common.created_at')),
            $helper->column('updated_at')
                ->label(__('common.updated_at')),
        ];
    }
}
