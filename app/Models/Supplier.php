<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = ['id', 'email', 'phone', 'tax_number', 'is_active'];
    public $translatedAttributes = ['company_name', 'address', 'notes'];

    static function getSupplier()
    {
        return self::select('*')->orderBy('id', 'DESC')->paginate(10);
    }

    static function singleSupplier($id)
    {
        return self::find($id);
    }

    public function scopeActive()
    {
        return self::where('is_active', 1)->get();
    }

    public function order()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function getActive()
    {
        return $this->is_active == 0 ? __('general.inactive') : __('general.active');
    }
}
