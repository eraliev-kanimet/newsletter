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
            $helper->column('name')
                ->label(__('common.name'))
                ->requiredMapping()
                ->rules(['required', 'email']),
        ];
    }

    public function resolveRecord(): Receiver
    {
        $receiver = Receiver::whereNotNull('data->email')
            ->where('data->email', $this->data['email'] ?? '')
            ->whereUserId($this->getImport()->user_id)
            ->first();

        return $receiver ?: Receiver::create([
            'user_id' => $this->getImport()->user_id,
            'data' => [
                'email' => $this->data['email'] ?? '',
                'name' => $this->data['name'] ?? '',
            ],
            'is_active' => $this->data['is_active'],
        ]);
    }
}
