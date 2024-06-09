<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Filament\Resources\UserResource\UserResourceForm;
use App\Models\User;
use Exception;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string
    {
        return __('common.edit_user');
    }

    /**
     * @var string|int|Model|User|null
     */
    public string|int|null|Model|User $record;

    public function form(Form $form): Form
    {
        return parent::form($form)->schema(UserResourceForm::form());
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['password'] = null;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (isset($data['password']) && $data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $this->record->password;
        }

        return $data;
    }

    /**
     * @throws Exception
     */
    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
