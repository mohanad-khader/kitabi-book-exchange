<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إنشاء مستخدم تجريبي
        User::create([
            'name' => 'أحمد محمد',
            'email' => 'ahmed@kitabi.ps',
            'password' => Hash::make('password123'),
            'whatsapp' => '0591234567', // 10 أرقام
            'region' => 'north_gaza',
            'university' => 'جامعة الأقصى',
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => 'سارة خليل',
            'email' => 'sara@kitabi.ps',
            'password' => Hash::make('password123'),
            'whatsapp' => '0562345678', // 10 أرقام
            'region' => 'gaza',
            'university' => 'جامعة الأزهر',
            'email_verified_at' => now(),
        ]);
        
        User::create([
            'name' => 'محمد أبو عمر',
            'email' => 'mohammed@kitabi.ps',
            'password' => Hash::make('password123'),
            'whatsapp' => '+970593456789', // 13 رمزاً مع +
            'region' => 'central',
            'university' => 'جامعة غزة',
            'email_verified_at' => now(),
        ]);

        // إنشاء 10 مستخدمين عشوائيين
        User::factory(10)->create();
    }
}