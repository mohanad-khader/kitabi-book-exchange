<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // الحصول على جميع المستخدمين
        $users = User::all();
        
        if ($users->isEmpty()) {
            $this->call(UsersTableSeeder::class);
            $users = User::all();
        }

        // كتب للمستخدم الأول
        if ($user1 = $users->first()) {
            Book::create([
                'user_id' => $user1->id,
                'title' => 'أساسيات الكيمياء العضوية',
                'author' => 'د. محمد أحمد',
                'description' => 'كتاب شامل لمبادئ الكيمياء العضوية، مناسب لطلاب السنة الأولى في الكليات العلمية.',
                'type' => 'free',
                'price' => null,
                'category' => 'university',
                'subject' => 'الكيمياء',
                'status' => 'available',
                'condition' => 'good',
                'region' => 'north_gaza',
                'view_count' => 42,
            ]);

            Book::create([
                'user_id' => $user1->id,
                'title' => 'الرياضيات الهندسية',
                'author' => 'د. علي محمود',
                'description' => 'كتاب متخصص في الرياضيات الهندسية مع تمارين محلولة، مناسب لطلاب الهندسة.',
                'type' => 'paid',
                'price' => 25.00,
                'category' => 'university',
                'subject' => 'الرياضيات',
                'status' => 'available',
                'condition' => 'new',
                'region' => 'north_gaza',
                'view_count' => 18,
            ]);
        }

        // كتب للمستخدم الثاني
        if ($user2 = $users->skip(1)->first()) {
            Book::create([
                'user_id' => $user2->id,
                'title' => 'تعلم اللغة الإنجليزية',
                'author' => 'سارة خليل',
                'description' => 'كتاب شامل لتعلم اللغة الإنجليزية من الصفر، يحتوي على تمارين وتطبيقات عملية.',
                'type' => 'paid',
                'price' => 15.00,
                'category' => 'general',
                'subject' => 'اللغة الإنجليزية',
                'status' => 'available',
                'condition' => 'acceptable',
                'region' => 'gaza',
                'view_count' => 35,
            ]);

            Book::create([
                'user_id' => $user2->id,
                'title' => 'علم النفس التربوي',
                'author' => 'د. فاطمة علي',
                'description' => 'كتاب متخصص في علم النفس التربوي، مناسب لطلاب التربية وعلم النفس.',
                'type' => 'free',
                'price' => null,
                'category' => 'university',
                'subject' => 'علم النفس',
                'status' => 'exchanged',
                'condition' => 'good',
                'region' => 'gaza',
                'view_count' => 67,
            ]);
        }

        // إنشاء 20 كتاب عشوائي
        Book::factory(20)->create();
    }
}