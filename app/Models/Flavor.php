<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use \Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flavor extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = ['id', 'admin_id', 'is_active'];
    public $translatedAttributes = ['name'];

    static function getFlavor()
    {
        return self::select('*')->orderBy('id', 'DESC')->paginate(10);
    }

    static function singleFlavor($id)
    {
        return self::find($id);
    }

    public function scopeActive($id)
    {
        return self::select('*')->where('is_active', 1)->get();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


}
