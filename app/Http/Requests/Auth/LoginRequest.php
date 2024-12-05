<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string' ],   // , 'email'
            'password' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'يجب إدخال البريد الالكتروني أو اسم المستخدم',
            'login.string' => 'يرجى إدخال بريد الكتروني أو اسم مستخدم صالح',
            'password.required' => 'يجب إدخال كلمة المرور',
            'password.string' => 'يرجى إدخال كلمة مرور صالحة',

        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate() : void
    {
        $this->ensureIsNotRateLimited();

        $login_type = filter_var($this->input('login'), FILTER_VALIDATE_EMAIL ) 
        ? 'email' 
        : 'name'; 
     
        $this->merge([ 
            $login_type => $this->input('login') 
        ]); 
    
$user = User::where($login_type , $this->login)->first();
if($user){
    if(! $user->active){
        throw ValidationException::withMessages([
            'login' => 'عفواً هذا الحساب تم تعطيله من قبل المدير',
        ]);
    
    }
}else{
    throw ValidationException::withMessages([
        'login' => trans('auth.failed'),
    ]);
}


        if (! Auth::attempt($this->only($login_type, 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'login' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'login' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('login')).'|'.$this->ip());
    }


}

