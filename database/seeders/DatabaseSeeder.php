<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $this->call([
            UsersTableSeeder::class,
            BooksTableSeeder::class,
        ]);

        echo "\n🎉 تم إكمال تعبئة قاعدة البيانات بنجاح!\n";
        echo "📊 الإحصائيات:\n";
        echo "   👥 المستخدمين: " . User::count() . "\n";
        echo "   📚 الكتب: " . Book::count() . "\n";
    }
}