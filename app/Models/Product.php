<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //


      protected $guarded = [];

    public function productSize()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'id');
    }


    public function product_size()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'id');
    }

    public function optionalItem()
    {
        return $this->hasMany(OptionalItem::class, 'product_id', 'id');
    }

     public function category()
    {
        return $this->belongsTo(Category::class, 'product_category', 'id');
    }

    public function image_gallaries()
    {
        return $this->hasMany(ImageGallery::class, 'product_id', 'id');
    }



}
