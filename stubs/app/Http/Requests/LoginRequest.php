<?php

namespace App\Http\Requests\Skyriver;

use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Cache\RateLimiter;
use Illuminate\Validation\ValidationException;
use Patrixsmart\Skyriver\PasswordValidationRules;

class LoginRequest extends FormRequest
{
    use PasswordValidationRules;

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! $this->attemptLogin()) {

            $this->incrementLoginAttempts();

            $this->sendFailedLoginResponse();
        }

        $this->clearLoginAttempts();
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials()
    {
        return $this->only($this->username(), 'password');
    }


    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin()
    {
        return $this->guard()->attempt(
            $this->credentials($this), $this->filled('remember')
        );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            $this->username() => 'required|string',
            'password' => $this->passwordRules(),
        ];
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }


    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! $this->hasTooManyLoginAttempts()) {
            return;
        }

        $this->fireLockoutEvent($this);

        return $this->sendLockoutResponse($this);
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts()
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey(), $this->maxAttempts()
        );
    }

    /**
     * Get the rate limiter instance.
     *
     * @return \Illuminate\Cache\RateLimiter
     */
    protected function limiter()
    {
        return app(RateLimiter::class);
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendLockoutResponse()
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($this)
        );

        throw ValidationException::withMessages([
            $this->username() => [Lang::get('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ])],
        ])->status(Response::HTTP_TOO_MANY_REQUESTS);
    }


    /**
     * Get the throttle key for the given request.
     *
     * @return string
     */
    protected function throttleKey()
    {
        return Str::lower($this->input($this->username())).'|'.$this->ip();
    }

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 5;
    }


    /**
     * Fire an event when a lockout occurs.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function fireLockoutEvent()
    {
        event(new Lockout($this));
    }

    /**
     * Increment the login attempts for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function incrementLoginAttempts()
    {
        $this->limiter()->hit(
            $this->throttleKey($this), $this->decayMinutes() * 60
        );
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes : 1;
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Clear the login locks for the given user credentials.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function clearLoginAttempts()
    {
        $this->limiter()->clear($this->throttleKey($this));
    }

     /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
