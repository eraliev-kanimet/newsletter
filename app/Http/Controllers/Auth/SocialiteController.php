<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\SocialAccount\SocialAccountServiceInterface;
use App\Contracts\User\UserCreateServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Enums\SocialiteProvider;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect(string $provider)
    {
        $provider = SocialiteProvider::key($provider);

        return Socialite::driver($provider->name)->redirect();
    }

    public function callback(
        string                        $provider,
        UserServiceInterface          $userService,
        UserCreateServiceInterface    $userCreateService,
        SocialAccountServiceInterface $socialAccountService,
    )
    {
        $provider = SocialiteProvider::key($provider);

        try {
            $socialite = Socialite::driver($provider->name)->stateless()->user();
        } catch (RequestException) {
            return $this->redirectToHome();
        }

        $account = $socialAccountService->find($provider, $socialite->getId());

        if ($account) {
            $userService->set($account->user)->login();

            return $this->redirectToHome();
        }

        try {
            if (!$socialite->getEmail()) {
                throw new ModelNotFoundException;
            }

            $userService->findAndSet([
                'email' => $socialite->getEmail(),
            ]);
        } catch (ModelNotFoundException) {
            $userService = $userCreateService->execute([
                'email' => $socialite->getEmail() ?? null,
                'name' => $socialite->getName() ?? null,
            ]);
        }

        $socialAccountService->create([
            'user_id' => $userService->get()->id,
            'provider' => $provider->value,
            'provider_id' => $socialite->getId(),
            'token' => $socialite->token,
        ]);

        $userService->login();

        return $this->redirectToHome();
    }

    protected function redirectToHome()
    {
        return redirect()->route(config('routes.web.home'));
    }
}
