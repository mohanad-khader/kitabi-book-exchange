<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * إعادة التوجيه إلى Google
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * معالجة رد Google
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // البحث عن المستخدم أو إنشاؤه
            $user = User::findByEmailOrCreate($googleUser);
            
            // تسجيل دخول المستخدم
            Auth::login($user, true);
            
            // إعادة التوجيه إلى الصفحة الرئيسية
            return redirect()->route('home')->with('success', 'تم تسجيل الدخول بنجاح!');
            
        } catch (\Exception $e) {
            \Log::error('Google Auth Error: ' . $e->getMessage());
            
            return redirect()->route('login')
                ->with('error', 'حدث خطأ أثناء تسجيل الدخول عبر Google. الرجاء المحاولة مرة أخرى.');
        }
    }

    /**
     * ربط حساب Google بحساب موجود
     */
    public function linkGoogleAccount(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = Auth::user();
            
            $user->update([
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'avatar' => $googleUser->avatar ?? $user->avatar,
            ]);
            
            return redirect()->route('profile.show')
                ->with('success', 'تم ربط حساب Google بنجاح!');
                
        } catch (\Exception $e) {
            return redirect()->route('profile.show')
                ->with('error', 'حدث خطأ أثناء ربط حساب Google.');
        }
    }

    /**
     * إلغاء ربط حساب Google
     */
    public function unlinkGoogleAccount(Request $request)
    {
        $user = Auth::user();
        
        $user->update([
            'google_id' => null,
            'google_token' => null,
            'google_refresh_token' => null,
        ]);
        
        return redirect()->route('profile.show')
            ->with('success', 'تم إلغاء ربط حساب Google بنجاح!');
    }
}