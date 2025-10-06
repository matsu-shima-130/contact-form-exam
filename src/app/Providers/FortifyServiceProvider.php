<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\ResetUserPassword;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\AuthLoginRequest;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;
use App\Http\Requests\FortifyEmptyLoginRequest;

class FortifyServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind(FortifyLoginRequest::class, FortifyEmptyLoginRequest::class);

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::registerView(fn () => view('register'));
        Fortify::loginView(fn () => view('login'));

        Fortify::authenticateUsing(function (Request $request) {
            $form = app(AuthLoginRequest::class);

            Validator::make(
                $request->all(),
                $form->rules(),
                $form->messages()
            )->validate();

            $user = User::where('email', $request->input('email'))->first();

            return ($user && Hash::check($request->input('password'), $user->password))
                ? $user
                : null;
        });
    }
}