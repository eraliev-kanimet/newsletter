<?php

namespace App\Filament\Form;

use App\Enums\SocialiteProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileForm
{
    public static function schema(array $social_accounts): array
    {
        $helper = filamentFormHelper();

        return [
            $helper->tabs([
                $helper->tab(__('common.basic'), [
                    $helper->input('email')
                        ->label(__('common.email'))
                        ->required()
                        ->email()
                        ->unique(ignorable: fn(?User $record): ?User => $record),
                    $helper->input('name')
                        ->label(__('common.name'))
                        ->required()
                        ->unique(ignorable: fn(?User $record): ?User => $record),
                    $helper->input('password')
                        ->label(__('common.password'))
                        ->password()
                        ->minLength(8)
                        ->confirmed(),
                    $helper->input('password_confirmation')
                        ->label(__('common.password_confirmation'))
                        ->password(),
                ])->columns(),
                $helper->tab(
                    __('common.social_accounts'),
                    array_map(function ($provider) use ($helper) {
                        return $helper
                            ->toggle("social_accounts.$provider")
                            ->disabled(fn($state) => !$state)
                            ->dehydrated();
                    }, array_keys($social_accounts))
                ),
            ]),
        ];
    }

    public static function save(array $original, array $data): void
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = Auth::user();

        $user->update($data);

        foreach ($original['social_accounts'] as $key => $value) {
            if (!$value) {
                $user->socialAccounts()->whereProvider(SocialiteProvider::key($key)->value)->delete();
            }
        }
    }
}
