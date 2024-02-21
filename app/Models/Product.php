<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_id',
        'product_category_id',
        'name',
        'descripton',
        'price',
        'qty',
        'discount',
        'featured'
    ];
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function product_images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function product_comments()
    {
        return $this->hasMany(ProductComment::class);
    }
}
