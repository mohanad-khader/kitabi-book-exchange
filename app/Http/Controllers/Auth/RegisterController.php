<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';  
    // when user register redirect to "/" instead of "/home"

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'whatsapp' => [
                'nullable',
                'string',
                'max:20',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) {
                        $errorMessage = '';
                        if (!User::validateWhatsapp($value)) {
                            // إنشاء رسالة خطأ مفصلة
                            $errorMessage = 'رقم غير صحيح. التنسيقات المقبولة:' . "\n" .
                                           '• 059xxxxxxx أو 056xxxxxxx' . "\n" .
                                           '• +97259xxxxxxx أو +97256xxxxxxx' . "\n" .
                                           '• +97059xxxxxxx أو +97056xxxxxxx' . "\n" .
                                           '• 0097259xxxxxxx أو 0097256xxxxxxx' . "\n" .
                                           '• 0097059xxxxxxx أو 0097056xxxxxxx';                            
                            
                           $fail($errorMessage);
                        }
                    }
                },
            ],
            'region' => ['required', 'in:north_gaza,gaza,central,khan_younis,rafah'],
            'university' => ['nullable', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'whatsapp' => $data['whatsapp'] ?? null,
            'region' => $data['region'],
            'university' => $data['university'] ?? null,
        ]);
    }
}