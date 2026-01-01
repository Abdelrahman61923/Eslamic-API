<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Azkar extends Model
{
    use HasFactory;

    protected $fillable = [
        'azkar_category_id', 'zekr', 'description', 'reference', 'order', 'count',
    ];

    // Relations
    public function azkarCategory()
    {
        return $this->belongsTo(AzkarCategory::class);
    }
}
