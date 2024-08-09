<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id', 'id');
    }
}
