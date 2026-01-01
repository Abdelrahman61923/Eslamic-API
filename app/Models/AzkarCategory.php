<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AzkarCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'order',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    // Relations
    public function azkars()
    {
        return $this->hasMany(Azkar::class)->orderBy('order');
    }
}
