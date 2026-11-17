<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = ['id', 'type', 'branch_id', 'admin_id', 'phone', 'is_active'];
    public $translatedAttributes = ['name', 'address', 'notes'];

    static function getWarehouse()
    {
        return self::select('*')->orderBy('id', 'DESC')->get();
    }

    static function singleWarehouse($id)
    {
        return self::find($id);
    }

    static function scopeActive()
    {
        return self::select('*')->where('is_active', 1)->get();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function getActive()
    {
        return $this->is_active == 0 ? __('general.inactive') : __('general.active');
    }

}
