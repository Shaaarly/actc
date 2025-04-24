<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;

use App\Models\User;                  
use Illuminate\Support\Facades\Hash;  

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Fortify\Responses\UpdatePasswordResponse;
use Laravel\Fortify\Contracts\UpdateUserPasswordResponse;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(UpdateUserPasswordResponse::class, UpdatePasswordResponse::class);
    }

    public function boot(): void
    {
        // Las acciones “oficiales” que Fortify provee
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // Autenticación: email + password
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }
        });

        // Limitadores de tasa
        RateLimiter::for('login', function (Request $request) {
            $key = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());
            return Limit::perMinute(5)->by($key);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // 1) Vistas de login y registro
        Fortify::loginView(fn() => view('auth.login'));
        Fortify::registerView(fn() => view('auth.register'));

        // 2) Vista para solicitar el enlace de restablecimiento
        Fortify::requestPasswordResetLinkView(fn() => view('auth.passwords.forgot'));

        // 3) Vista para restablecer la contraseña (recibe el Request con token + email)
        Fortify::resetPasswordView(fn(Request $request) =>
            view('auth.passwords.reset', ['request' => $request])
        );

        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                return match (auth()->user()->role_id) {
                    2, 3 => redirect()->route('users.index'),
                    1 => redirect()->route('profile'),
                    default => redirect('/'),
                };
            }
        });

        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });
    }
}
