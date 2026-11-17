<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Material extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'id',
        'code',
        'material_category_id',
        'unit_id',
        'roast_level_id',
        'barcode',
        'min_stock_level',
        'reorder_level',
        'max_stock_level',
        'cost_price',
        'currency',
        'shelf_life_days',
        'is_perishable',
        'is_active'
        ];

    public $translatedAttributes = ['name', 'description', 'notes'];

    static function getMaterial()
    {
        return self::select('*')->orderBy('id', 'DESC')->get();
    }

    static function singleMaterial($id)
    {
        return self::find($id);
    }

    static function scopeActive()
    {
        return self::select('*')->where('is_active', 1)->get();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function roastLevel()
    {
        return $this->belongsTo(RoastLevel::class);
    }

    public function materialCategory()
    {
        return $this->belongsTo(MaterialCategory::class);
    }

    public function getActive()
    {
        return $this->is_active == 0 ? __('general.inactive') : __('general.active');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($material){
            if (empty($material->code)){
                $material->code = self::generateCode($material->material_category_id);
            }
        });
    }

    public static function generateCode(int $material_category_id)
    {
        $category = MaterialCategory::singleMaterial($material_category_id);
        $prefix = 'SO-' . strtoupper(Str::slug($category->code, ''));

        $lastCode = self::where('code', 'like', $prefix . '-%')->orderByDesc('id')->value('code');
        $nextNumber = $lastCode ? (int) substr($lastCode, -3) +1 : 1;

        return $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);
    }

}
