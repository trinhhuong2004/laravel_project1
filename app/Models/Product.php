<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'img_thumb',
        'price',
        'price_sale',
        'material',
        'description',
        'use_manual',

    ];
    public $casts = [
        'is_active' => 'boolean',
        'is_best_sale' => 'boolean',
        'is_40_sale' => 'boolean',
        'is_hot_online' => 'boolean',
    ];
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, );
    }}
