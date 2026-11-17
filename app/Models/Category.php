<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable, SoftDeletes;

    protected $fillable = ['id', 'admin_id', 'parent_id', 'is_active'];
    public $translatedAttributes = ['name'];

    static function getCategory()
    {
        return self::select('*')->whereNull('parent_id')->orderBy('id', 'DESC')->paginate(10);
    }

    static function category()
    {
        return self::select('*')->orderBy('id', 'DESC')->get();
    }

    static function getSubCategory()
    {
        return self::select('*')->whereNotNull('parent_id')->orderBy('id', 'DESC')->paginate(10);
    }

    static function scopeActive()
    {
        return self::select('*')->where('is_active', 1)->where('parent_id')->get();
    }

    static function singleCategory($id)
    {
        return self::find($id);
    }

    public function child()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeActiveMain($query)
    {
        $data = [];
        $data = $query->where('is_active', 1);
        $data = $query->whereNull('parent_id');
        return $data;
    }

    public function scopeActiveSub($query)
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
