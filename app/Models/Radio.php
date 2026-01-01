<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'url',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
