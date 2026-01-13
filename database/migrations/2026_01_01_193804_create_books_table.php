<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('author');
            $table->text('description')->nullable();
            $table->enum('type', ['free', 'paid']);
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('category', ['university', 'school', 'general']);
            $table->string('subject')->nullable();
            $table->enum('status', ['available', 'negotiating', 'exchanged'])->default('available');
            $table->enum('condition', ['new', 'good', 'acceptable'])->nullable();
            $table->string('image')->nullable();
            $table->enum('region', ['north_gaza', 'gaza', 'central', 'khan_younis', 'rafah']);
            $table->integer('view_count')->default(0);
            $table->timestamps();

            $table->index(['status', 'region']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};