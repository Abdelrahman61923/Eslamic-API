<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'name', 'url', 'revelation_type'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function ayahs()
    {
        return $this->hasMany(Ayah::class);
    }
}
