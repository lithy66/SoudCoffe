<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = ['id', 'type', 'admin_id', 'phone', 'is_online', 'open', 'close', 'is_active'];
    public $translatedAttributes = ['name', 'address'];

    static function getBranch()
    {
        return self::select('*')->orderBy('id', 'desc')->get();
    }

    static function singleBranch($id)
    {
        return self::find($id);
    }

    static function scopeActive()
    {
        return self::select('*')->where('is_active', 1)->orderBy('id', 'desc')->get();
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function warehouse()
    {
       return $this->hasMany();
    }

    public function getType()
    {

        if ($this->type == 'dine_in')
            $type = __('admin/body.dine in');
        elseif ($this->type == 'kiosk')
            $type = __('admin/body.kiosk');
        else
            $type = __('admin/body.takeaway');
        return $type;
    }

    public function getActive()
    {
        return $this->is_active == 0 ? __('general.inactive') : __('general.active');
    }
}
