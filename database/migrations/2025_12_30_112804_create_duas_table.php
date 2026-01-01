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
        Schema::create('duas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dua_category_id')->constrained('dua_categories')->cascadeOnDelete();
            $table->text('dua');
            $table->string('reference')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->unsignedInteger('count')->default(1);
            $table->timestamps();

            $table->unique(['dua_category_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('duas');
    }
};
