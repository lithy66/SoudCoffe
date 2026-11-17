<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Laravel\Prompts\select;

class MaterialCategory extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    public $fillable = ['id', 'parent_id', 'is_active', 'code'];
    public $translatedAttributes = ['name'];

    static function getMaterial()
    {
        return self::select('*')->whereNull('parent_id')->orderBy('id', 'DESC')->get();
    }

    static function getSubMaterial()
    {
        return self::select('*')->whereNotNull('parent_id')->orderBy('id', 'DESC')->get();
    }

    static function singleMaterial($id)
    {
        return self::find($id);
    }

    public function scopeActive($query)
    {
        return $query->whereNull('parent_id')->where('is_active', 1)->get();
    }

    public function materialC()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function subMaterial()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function scopeActiveMaterial($query)
    {
        $data = [];
        $data = $query->where('is_active', 1);
        $data = $query->whereNull('parent_id');
        return $data;
    }

    public function scopeActiveSubMaterial($query)
    {
        $data = [];
        $data = $query->where('is_active', 1);
        $data = $query->whereNotNull('parent_id');
        return $data;
    }

    public function getActive()
    {
        return $this->is_active == 0 ? __('general.inactive') : __('general.active');
    }
}
