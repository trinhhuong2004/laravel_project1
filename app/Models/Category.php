<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover',
        'name',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Định nghĩa mối quan hệ với Product
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
