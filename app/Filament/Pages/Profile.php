<?php


namespace App\Filament\Pages;

use App\Enums\SocialiteProvider;
use App\Filament\Form\ProfileForm;
use Filament\Forms\Form;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

/**
 * @property Form $form
 */
class Profile extends Page
{
    use InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static string $view = 'filament.pages.profile';

    public static function getNavigationLabel(): string
    {
        return __('common.profile');
    }

    public function getTitle(): string
    {
        return __('common.profile');
    }

    public mixed $previousUrl;
    public mixed $name;
    public mixed $email;
    public mixed $password = '';
    public mixed $password_confirmation = '';
    public array $social_accounts = [];

    public function mount(): void
    {
        $user = Auth::user();

        $this->name = $user->name;
        $this->email = $user->email;

        $this->social_accounts = SocialiteProvider::dataForAdmin($user);

        $this->previousUrl = url()->previous();
    }

    protected function getFormSchema(): array
    {
        return ProfileForm::schema($this->social_accounts);
    }

    protected function getFormActions(): array
    {
        $helper = filamentActionHelper();

        return [
            $helper->action('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save')
                ->keyBindings(['mod+s']),
            $helper->action('cancel')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.cancel.label'))
                ->url($this->previousUrl ?? '/admin')
                ->color('gray')
        ];
    }

    public function save(): void
    {
        $original = $this->form->getState();

        $data = array_filter_on_null($original);

        ProfileForm::save($original, $data);

        if (isset($data['password'])) {
            $this->redirect(route('auth.login.page'));
        } else {
            $helper = filamentNotificationHelper();

            $helper->success(__('admin.save_success'));
        }
    }
}
