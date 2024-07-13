<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use Translatable;
    use SoftDeletes;
    protected $with = ['translations'];
    protected $fillable = ['brand_id', 'slug', 'price', 'special_price', 'special_price_type', 'special_price_start'
        , 'special_price_end', 'selling_price', 'sku', 'manage_stock', 'qty', 'in_stock', 'viewed', 'is_active'
    ];
    protected $casts = ['manage_stock'=>'boolean', 'in_stock' => 'boolean', 'is_active'=>'boolean'];
    protected $dates = ['special_price_start', 'special_price_end', 'deleted_at'];
    protected $translatedAttributes = ['name', 'description', 'short_description'];
    public function brand(){//one to many
        return $this->belongsTo(Brand::class)->withDefault();
    }
    public function categories()//many to many
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }
    public function tags()//many to many
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
}
