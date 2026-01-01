<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
    use HasFactory;

    protected $fillable = [
        'surah_id', 'number', 'number_in_surah', 'ayah', 'juz', 'page',
        'hizb_quarter', 'sajda', 'audio_128',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
}
