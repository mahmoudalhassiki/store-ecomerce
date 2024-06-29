<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;
    protected $table = "setting_translations";
    protected $guarded = [];
    //protected $fillable = ['setting_id', 'locale', 'value'];
    public $timestamps = false;
}
