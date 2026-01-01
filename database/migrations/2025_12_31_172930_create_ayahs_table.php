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
        Schema::create('ayahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surah_id')->constrained('surahs')->cascadeOnDelete();
            $table->integer('number');
            $table->integer('number_in_surah');
            $table->text('ayah');
            $table->integer('juz');
            $table->integer('page');
            $table->integer('hizb_quarter');
            $table->boolean('sajda')->default(false);
            $table->string('audio_128');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayahs');
    }
};
