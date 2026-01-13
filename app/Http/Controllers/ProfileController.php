<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display the user's profile
     */
    public function show()
    {
        $user = Auth::user();
        $user->load('books');
        
        // تقسيم الكتب حسب الحالة
        $availableBooks = $user->books()->where('status', 'available')->get();
        $negotiatingBooks = $user->books()->where('status', 'negotiating')->get();
        $exchangedBooks = $user->books()->where('status', 'exchanged')->get();

        return view('profile.show', compact('user', 'availableBooks', 'negotiatingBooks', 'exchangedBooks'));
    }

    /**
     * Show the form for editing the user's profile
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile
     */
   public function update(Request $request)
    {
        $user = Auth::user();
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users,email,' . $user->id,
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
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp, // سيتم تنسيقه تلقائياً في الـ setter
            'region' => $request->region,
            'university' => $request->university,
        ];
    
        // تحديث كلمة المرور إذا تم تقديمها
        if ($request->filled('new_password')) {
            // التحقق من كلمة المرور الحالية
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()
                    ->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة'])
                    ->withInput();
            }
            
            $data['password'] = Hash::make($request->new_password);
        }
    
        $user->update($data);
    
        return redirect()->route('profile.show')
            ->with('success', 'تم تحديث الملف الشخصي بنجاح!');
    }
}