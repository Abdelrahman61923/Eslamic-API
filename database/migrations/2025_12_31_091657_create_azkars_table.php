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
        Schema::create('azkars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('azkar_category_id')->constrained('azkar_categories')->cascadeOnDelete();
            $table->text('zekr');
            $table->string('description')->nullable();
            $table->string('reference')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->unsignedInteger('count')->default(1);
            $table->timestamps();

            $table->unique(['azkar_category_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('azkars');
    }
};
