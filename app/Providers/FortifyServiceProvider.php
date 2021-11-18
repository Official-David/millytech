<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Contracts\LogoutResponse as LogoutResponseContract;
use Laravel\Fortify\Http\Responses\LogoutResponse;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\AuthenticatedSessionController as ControllersAuthenticatedSessionController;
use Laravel\Fortify\Contracts\RegisterResponse as ContractsRegisterResponse;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Responses\RegisterResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Request::macro('isAdmin', fn() => config('domain.admin') == request()->getHost());
        Request::macro('isUser', fn() => config('domain.user') == request()->getHost());

        if (request()->isAdmin()) {
            config(['fortify.guard' => 'admin']);
            config(['fortify.domain' => admin_domain()]);
        }

        if (request()->isUser()) {
            config(['fortify.guard' => 'user']);
            config(['fortify.domain' => user_domain()]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(fn() => view('auth.login'));


        Fortify::registerView(fn() => view('auth.register'));

        Fortify::requestPasswordResetLinkView(fn() => view('auth.passwords.forgot'));

        Fortify::resetPasswordView(fn($request) => view('auth.passwords.reset',compact('request')));

        $this->app->singleton(AuthenticatedSessionController::class, ControllersAuthenticatedSessionController::class);


        // $this->app->instance(LogoutResponse::class, new class implements LogoutResponseContract {
        //     public function toResponse($request)
        //     {
        //         return redirect('/');
        //     }
        // });

        // $this->app->instance(RegisterResponse::class, new class implements ContractsRegisterResponse {
        //     public function toResponse($request)
        //     {
        //         return redirect()->route('user.dashboard');
        //     }
        // });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
