<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    use Translatable;
    protected $with = ['translations'];
    protected $hidden = ['translations'];
    protected $fillable = ['is_active', 'photo'];
    protected $casts = ['is_active' => 'boolean'];
    protected  $translatedAttributes = ['name'];
    public function getActive()
    {
        return $this->is_active == 1 ? __("admin\sidebar.enabled") : __("admin\sidebar.not enabled") ;
    }
    public function getphotoAttribute($val)
    {
        return ($val != Null) ? asset('assets/images/brands/' . $val) : '';
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
