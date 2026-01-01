<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dua extends Model
{
    use HasFactory;

    protected $fillable = [
        'dua_category_id', 'dua', 'reference', 'order', 'count',
    ];

    // Relations
    public function duaCategory()
    {
        return $this->belongsTo(DuaCategory::class);
    }
}
