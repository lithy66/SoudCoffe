<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = ['id', 'base_unit_id', 'symbol', 'conversion_factory', 'is_active'];
    public $translatedAttributes = ['name'];

    static function getUnit()
    {
        return self::select('*')->whereNull('base_unit_id')->orderBy('id', 'DESC')->paginate(10);
    }

    static function getBaseUnit()
    {
        return self::select('*')->whereNotNull('base_unit_id')->orderBy('id', 'DESC')->paginate(10);
    }

    static function singleUnit($id)
    {
        return self::find($id);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('base_unit_id')->where('is_active', 1)->get();
    }

    public function unit()
    {
        return $this->belongsTo(self::class, 'base_unit_id', 'id');
    }

    public function baseUnit()
    {
        return $this->hasMany(self::class, 'base_unit_id', 'id');
    }

    public function getActive()
    {
        return $this->is_active == 0 ? __('general.inactive') : __('general.active');
    }
}
