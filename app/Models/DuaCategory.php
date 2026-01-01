<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DuaCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'order',
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    // Relations
    public function duas()
    {
        return $this->hasMany(Dua::class)->orderBy('order');
    }
}
