<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'whatsapp',
        'region',
        'university',
        'google_id',
        'google_token',
        'google_refresh_token',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'google_token',
        'google_refresh_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     // دالة للبحث عن مستخدم بالبريد أو إنشاء جديد
    public static function findByEmailOrCreate($googleUser)
    {
        $user = self::where('email', $googleUser->email)->first();
        
        if (!$user) {
            // إنشاء اسم من Google إذا لم يكن موجوداً
            $name = $googleUser->name ?? $googleUser->email;
            
            $user = self::create([
                'name' => $name,
                'email' => $googleUser->email,
                'password' => bcrypt(Str::random(16)), // كلمة مرور عشوائية
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'avatar' => $googleUser->avatar,
                'email_verified_at' => now(), // تأكيد البريد تلقائياً
            ]);
        } else {
            // تحديث بيانات المستخدم الموجود
            $user->update([
                'google_id' => $googleUser->id,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'avatar' => $googleUser->avatar ?? $user->avatar,
            ]);
        }
        
        return $user;
    }

    // التحقق مما إذا كان المستخدم سجل عبر Google
    public function isGoogleUser()
    {
        return !is_null($this->google_id);
    }

    // Setter لرقم الواتساب - تنسيق الرقم تلقائياً
    public function setWhatsappAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['whatsapp'] = null;
            return;
        }

        // تنظيف الرقم من المسافات والرموز
        $cleaned = preg_replace('/[^0-9]/', '', $value);

        // جميع الأنماط المطلوبة:
        // 1. 059xxxxxxx أو 056xxxxxxx → تحويل إلى 97059xxxxxxx أو 97056xxxxxxx
        if (preg_match('/^(059|056)(\d{7})$/', $cleaned, $matches)) {
            $this->attributes['whatsapp'] = '970' . $matches[1] . $matches[2];
        }
        // 2. +97259xxxxxxx أو +97256xxxxxxx → تحويل إلى 97059xxxxxxx أو 97056xxxxxxx
        elseif (preg_match('/^972(59|56)(\d{7})$/', $cleaned, $matches)) {
            $this->attributes['whatsapp'] = '970' . $matches[1] . $matches[2];
        }
        // 3. +97059xxxxxxx أو +97056xxxxxxx → تأكيد التنسيق
        elseif (preg_match('/^970(59|56)(\d{7})$/', $cleaned, $matches)) {
            $this->attributes['whatsapp'] = $cleaned;
        }
        // 4. 0097259xxxxxxx أو 0097256xxxxxxx → تحويل إلى 97059xxxxxxx أو 97056xxxxxxx
        elseif (preg_match('/^00972(59|56)(\d{7})$/', $cleaned, $matches)) {
            $this->attributes['whatsapp'] = '970' . $matches[1] . $matches[2];
        }
        // 5. 0097059xxxxxxx أو 0097056xxxxxxx → تحويل إلى 97059xxxxxxx أو 97056xxxxxxx
        elseif (preg_match('/^00970(59|56)(\d{7})$/', $cleaned, $matches)) {
            $this->attributes['whatsapp'] = '970' . $matches[1] . $matches[2];
        }
        // إذا كان الرقم غير متوافق
        else {
            $this->attributes['whatsapp'] = $value; // سيتم رفضه في الـ validation
        }
    }

    // Getter للواتساب - إرجاع الرقم بتنسيق واتساب
    public function getWhatsappAttribute($value)
    {
        if (empty($value)) {
            return null;
        }
        
        // إذا كان التنسيق صحيحاً، أرجعه كما هو
        if (preg_match('/^\+(972|970)(59|56)\d{7}$/', $value)) {
            return $value;
        }
        
        // محاولة إصلاح التنسيق
        $cleaned = preg_replace('/[^0-9]/', '', $value);
        
        if (preg_match('/^(972|970)(59|56)\d{7}$/', $cleaned)) {
            return '+' . $cleaned;
        }
        
        return $value;
    }

    // دالة للتحقق من صحة رقم الواتساب
    public static function validateWhatsapp($number)
    {
        if (empty($number)) {
            return true; // مسموح أن يكون null
        }

        $cleaned = preg_replace('/[^0-9]/', '', $number);

        $patterns = [
            '/^059\d{7}$/',           // 059xxxxxxx
            '/^056\d{7}$/',           // 056xxxxxxx
            '/^\+97259\d{7}$/',       // +97259xxxxxxx
            '/^\+97256\d{7}$/',       // +97256xxxxxxx
            '/^\+97059\d{7}$/',       // +97059xxxxxxx
            '/^\+97056\d{7}$/',       // +97056xxxxxxx
            '/^0097259\d{7}$/',       // 0097259xxxxxxx
            '/^0097256\d{7}$/',       // 0097256xxxxxxx
            '/^0097059\d{7}$/',       // 0097059xxxxxxx
            '/^0097056\d{7}$/',       // 0097056xxxxxxx

            // إصدارات بدون + للتحقق من الأرقام المنظفة
            '/^97259\d{7}$/',         // 97259xxxxxxx
            '/^97256\d{7}$/',         // 97256xxxxxxx
            '/^97059\d{7}$/',         // 97059xxxxxxx (التنسيق الداخلي)
            '/^97056\d{7}$/',         // 97056xxxxxxx (التنسيق الداخلي)
            '/^059\d{7}$/',           // 059xxxxxxx
            '/^056\d{7}$/',           // 056xxxxxxx
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $cleaned)) {
                return true;
            }
        }

        return false;
    }

    // علاقة المستخدم بالكتب (One-to-Many)
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    // عد الكتب المعروضة
    public function getBooksListedCountAttribute()
    {
        return $this->books()->count();
    }

    // عد الكتب المتبادلة (التي تم بيعها/تبادلها)
    public function getBooksExchangedCountAttribute()
    {
        return $this->books()->where('status', 'exchanged')->count();
    }

    // الحصول على الكتب المتاحة حالياً
    public function getAvailableBooksAttribute()
    {
        return $this->books()->where('status', 'available')->get();
    }

    // الحصول على الكتب قيد التفاوض
    public function getNegotiatingBooksAttribute()
    {
        return $this->books()->where('status', 'negotiating')->get();
    }

    // الحصول على منطقة المستخدم كاسم عربي
    public function getRegionArabicAttribute()
    {
        $regions = [
            'north_gaza' => 'شمال غزة',
            'gaza' => 'غزة',
            'central' => 'الوسطى',
            'khan_younis' => 'خان يونس',
            'rafah' => 'رفح',
        ];
        
        return $regions[$this->region] ?? $this->region;
    }

    // التحقق مما إذا كان المستخدم لديه رقم واتساب
    public function hasWhatsapp()
    {
        return !empty($this->whatsapp);
    }

    // جعل رقم الواتساب آمناً للعرض (إخفاء جزئي)
    public function getSafeWhatsappAttribute()
    {
        if (!$this->whatsapp) {
            return null;
        }
        
        // إزالة علامة +
        $number = str_replace('+', '', $this->whatsapp);
        $length = strlen($number);
        
        if ($length <= 4) {
            return $number;
        }
        
        // إخفاء معظم الأرقام مع إظهار الأول والأخير
        return substr($number, 0, 3) . str_repeat('*', $length - 5) . substr($number, -2);
    }

    // الحصول على رابط واتساب مباشر
    public function getWhatsappLinkAttribute()
    {
        if (!$this->hasWhatsapp()) {
            return null;
        }
        
        // إزالة علامة + إذا كانت موجودة
        $number = str_replace('+', '', $this->whatsapp);
        return "https://wa.me/{$number}";
    }

    // إنشاء أفاتار مبدئي من اسم المستخدم
    public function getAvatarInitialAttribute()
    {
        if (empty($this->name)) {
            return '?';
        }
        
        // إزالة المسافات من البداية والنهاية
        $name = trim($this->name);
        
        // الحصول على أول حرف
        $firstChar = mb_substr($name, 0, 1, 'UTF-8');
        
        // إذا كان الحرف فارغاً أو مسافة
        if (empty($firstChar) || $firstChar == ' ') {
            return '?';
        }
        
        return $firstChar;
    }
}