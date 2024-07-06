<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $fillable = ['parent_id', 'slug', 'is_active'];
    protected $translatedAttributes = ['name'];
    protected $hidden = ['translations'];
    protected $casts = ['is_active' => 'boolean'];
    public function scopeParent($qurey)
    {
        return $qurey->whereNull('parent_id');
    }
    public function scopeChild($qurey)
    {
        return $qurey->whereNotNull('parent_id');
    }
    public function getActive()
    {
        return $this->is_active == 1 ? __("admin\sidebar.enabled") : __("admin\sidebar.not enabled") ;
    }
    public function _parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
