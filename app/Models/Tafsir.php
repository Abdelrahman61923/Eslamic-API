<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tafsir extends Model
{
    use HasFactory;

    protected $fillable = [
        'ayah_id', 'tafsir_id', 'text'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function ayah()
    {
        return $this->belongsTo(Ayah::class);
    }
}
