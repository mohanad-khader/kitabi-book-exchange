<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    /**
     * الحقول القابلة للتعبئة
     */
    protected $fillable = [
        'user_id',
        'title',
        'author',
        'description',
        'type',
        'price',
        'category',
        'subject',
        'status',
        'condition',
        'image',
        'region',
        'view_count'
    ];

    /**
     * القيم الافتراضية
     */
    protected $attributes = [
        'view_count' => 0,
        'status' => 'available',
    ];

    /**
     * تحويل أنواع الحقول
     */
    protected $casts = [
        'price' => 'decimal:2',
        'view_count' => 'integer',
    ];

    protected $appends = [
        'price_formatted',
        'status_arabic',
        'condition_arabic',
        'category_arabic',
        'type_arabic',
        'region_arabic',
    ];

    // علاقة الكتاب بالمستخدم (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // زيادة عدد المشاهدات
    public function incrementViews()
    {
        $this->increment('view_count');
    }

    // تغيير حالة الكتاب
    public function changeStatus($status)
    {
        if (in_array($status, ['available', 'negotiating', 'exchanged'])) {
            $this->update(['status' => $status]);
            return true;
        }
        return false;
    }

    // التحقق مما إذا كان الكتاب متاحاً
    public function isAvailable()
    {
        return $this->status === 'available';
    }

    // التحقق مما إذا كان الكتاب مجانياً
    public function isFree()
    {
        return $this->type === 'free';
    }

    // الحصول على السعر بصيغة منسقة
    public function getPriceFormattedAttribute()
    {
        if ($this->isFree()) {
            return 'مجاني';
        }
        
        return number_format($this->price, 2) . ' ₪';
    }

    // الحصول على الحالة بالعربية
    public function getStatusArabicAttribute()
    {
        $statuses = [
            'available' => 'متاح',
            'negotiating' => 'قيد التفاوض',
            'exchanged' => 'تم التبادل',
        ];
        
        return $statuses[$this->status] ?? $this->status;
    }

    // الحصول على الحالة الفيزيائية بالعربية
    public function getConditionArabicAttribute()
    {
        if (!$this->condition) {
            return 'غير محدد';
        }
        
        $conditions = [
            'new' => 'جديد',
            'good' => 'جيدة',
            'acceptable' => 'مقبول',
        ];
        
        return $conditions[$this->condition] ?? $this->condition;
    }

    // الحصول على التصنيف بالعربية
    public function getCategoryArabicAttribute()
    {
        $categories = [
            'university' => 'جامعي',
            'school' => 'مدرسي',
            'general' => 'عام',
        ];
        
        return $categories[$this->category] ?? $this->category;
    }

    // الحصول على النوع بالعربية
    public function getTypeArabicAttribute()
    {
        $types = [
            'free' => 'مجاني',
            'paid' => 'مدفوع',
        ];
        
        return $types[$this->type] ?? $this->type;
    }

    // الحصول على المنطقة بالعربية
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

    // نطاق الاستعلام: الكتب المتاحة فقط
    public function scopeAvailable(Builder $query)
    {
        return $query->where('status', 'available');
    }

    // نطاق الاستعلام: الكتب المجانية فقط
    public function scopeFree(Builder $query)
    {
        return $query->where('type', 'free');
    }

    // نطاق الاستعلام: الكتب المدفوعة فقط
    public function scopePaid(Builder $query)
    {
        return $query->where('type', 'paid');
    }

    // نطاق الاستعلام: البحث حسب المنطقة
    public function scopeByRegion(Builder $query, $region)
    {
        if ($region && in_array($region, ['north_gaza', 'gaza', 'central', 'khan_younis', 'rafah'])) {
            return $query->where('region', $region);
        }
        return $query;
    }

    // نطاق الاستعلام: البحث حسب التصنيف
    public function scopeByCategory(Builder $query, $category)
    {
        if ($category && in_array($category, ['university', 'school', 'general'])) {
            return $query->where('category', $category);
        }
        return $query;
    }

    // نطاق الاستعلام: البحث حسب النوع
    public function scopeByType(Builder $query, $type)
    {
        if ($type && in_array($type, ['free', 'paid'])) {
            return $query->where('type', $type);
        }
        return $query;
    }

    // نطاق الاستعلام: البحث بالنص (العنوان أو المؤلف)
    public function scopeSearch(Builder $query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhere('subject', 'LIKE', "%{$search}%");
            });
        }
        return $query;
    }

    // الحصول على رابط صورة الكتاب أو صورة افتراضية
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-book.jpg');
    }

    // إنشاء رسالة واتساب جاهزة
    public function getWhatsappMessageAttribute()
    {
        return "مرحبًا، أنا مهتم بكتاب \"" . $this->title . "\" الذي عرضته على منصة كتابي.";
    }

    // إنشاء رابط واتساب مباشر
    public function getWhatsappLinkAttribute()
    {
        if (!$this->user->hasWhatsapp()) {
            return null;
        }
        
        // احصل على الرقم و نظفه
        $number = preg_replace('/[^0-9]/', '', $this->user->whatsapp);
        
        // تأكد من التنسيق الصحيح لواتساب
        // واتساب يحتاج الرقم بدون + أو 00
        
        // إذا كان الرقم يبدأ بـ 972 أو 970، اتركه كما هو
        if (preg_match('/^(972|970)/', $number)) {
            // تأكد من طول الرقم (12 رقم)
            if (strlen($number) === 12) {
                $whatsappNumber = $number;
            } else {
                // إذا كان الرقم 13 رقم (مثل 970059...)، صححه
                if (preg_match('/^9700(59|56)(\d{7})$/', $number, $matches)) {
                    $whatsappNumber = '970' . $matches[1] . $matches[2];
                } elseif (preg_match('/^9720(59|56)(\d{7})$/', $number, $matches)) {
                    $whatsappNumber = '972' . $matches[1] . $matches[2];
                } else {
                    $whatsappNumber = $number;
                }
            }
        } 
        // إذا كان الركم يبدأ بـ 059 أو 056، حوله لـ 972
        elseif (preg_match('/^(059|056)(\d{7})$/', $number, $matches)) {
            $whatsappNumber = '972' . $matches[1] . $matches[2];
        }
        // إذا كان الرقم يبدأ بـ 59 أو 56 فقط
        elseif (preg_match('/^(59|56)(\d{7})$/', $number, $matches)) {
            $whatsappNumber = '972' . $matches[1] . $matches[2];
        }
        // أي تنسيق آخر
        else {
            $whatsappNumber = $number;
        }
        
        $message = urlencode($this->whatsapp_message);
        
        // رابط واتساب
        return "https://wa.me/{$whatsappNumber}?text={$message}";
    }
}