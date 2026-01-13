<?php

namespace App\Http\Requests;
use App\Models\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
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
            'region' => 'required|in:north_gaza,gaza,central,khan_younis,rafah',
            'university' => 'nullable|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'whatsapp.regex' => 'رقم غير صحيح. التنسيقات المقبولة:' . "\n" .
                                           '• 059xxxxxxx أو 056xxxxxxx' . "\n" .
                                           '• +97259xxxxxxx أو +97256xxxxxxx' . "\n" .
                                           '• +97059xxxxxxx أو +97056xxxxxxx' . "\n" .
                                           '• 0097259xxxxxxx أو 0097256xxxxxxx' . "\n" .
                                           '• 0097059xxxxxxx أو 0097056xxxxxxx',
        ];
    }
}