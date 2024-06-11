<?php

namespace App\Filament\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserImporter extends BaseImporter
{
    protected static ?string $model = User::class;

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
                ->rules(['required']),
            $helper->column('password')
                ->label(__('common.password'))
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    public function resolveRecord(): ?User
    {
         return User::firstOrNew([
             'email' => $this->data['email'],
         ], [
             'is_active' => $this->data['is_active'],
             'email' => $this->data['email'],
             'name' => $this->data['name'],
             'password' => Hash::make($this->data['password']),
             'roles' => [1],
         ]);
    }
}
