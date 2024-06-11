<?php

namespace App\Filament\Imports;

use App\Models\Receiver;

class ReceiverImporter extends BaseImporter
{
    protected static ?string $model = Receiver::class;

    public static function getColumns(): array
    {
        $helper = filamentImportHelper();

        return [
            $helper->column('is_active')
                ->label(__('common.active'))
                ->requiredMapping()
                ->boolean()
                ->rules(['required', 'boolean']),
            $helper->column('email')
                ->label(__('common.email'))
                ->requiredMapping()
                ->rules(['required', 'email']),
        ];
    }

    public function resolveRecord(): ?Receiver
    {
        $data = [
            'user_id' => $this->getImport()->user_id,
            'email' => $this->data['email'],
        ];

        return Receiver::firstOrNew($data, $data + [
                'is_active' => $this->data['is_active'],
            ]);
    }
}
