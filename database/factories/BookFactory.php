<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['free', 'paid']);
        $regions = ['north_gaza', 'gaza', 'central', 'khan_younis', 'rafah'];
        $categories = ['university', 'school', 'general'];
        $conditions = ['new', 'good', 'acceptable'];
        $statuses = ['available', 'available', 'available', 'negotiating', 'exchanged'];
        
        $bookTitles = [
            'أساسيات الكيمياء العضوية',
            'مبادئ الفيزياء العامة',
            'الرياضيات الهندسية',
            'تعلم اللغة الإنجليزية',
            'قواعد اللغة العربية',
            'تاريخ فلسطين',
            'برمجة الويب',
            'مبادئ المحاسبة',
            'علم النفس التربوي',
            'التربية الإسلامية',
        ];
        
        $authors = [
            'د. محمد أحمد',
            'د. خالد حسن',
            'د. علي محمود',
            'سارة خليل',
            'أحمد شوقي',
            'د. رامي عودة',
            'م. محمد أبو عمر',
            'د. سامي رشيد',
            'د. فاطمة علي',
            'د. عمر محمد',
        ];

        // Check if any users exist in database
        if (User::exists()) {
            $userId = User::inRandomOrder()->value('id');
        } else {
            $userId = User::factory();
        }

        return [
            'user_id' => $userId,
            'title' => $this->faker->randomElement($bookTitles),
            'author' => $this->faker->randomElement($authors),
            'description' => $this->faker->paragraph(3),
            'type' => $type,
            'price' => $type === 'paid' ? $this->faker->randomFloat(2, 10, 50) : null,
            'category' => $this->faker->randomElement($categories),
            'subject' => $this->faker->word(),
            'status' => $this->faker->randomElement($statuses),
            'condition' => $this->faker->randomElement($conditions),
            'region' => $this->faker->randomElement($regions),
            'view_count' => $this->faker->numberBetween(0, 150),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}