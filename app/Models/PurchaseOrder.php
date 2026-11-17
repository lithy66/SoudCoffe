<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model implements TranslatableContracts
{
    use HasFactory, SoftDeletes, Translatable;

    protected $fillable = [
        'id',
        'po_number',
        'supplier_id',
        'warehouse_id',
        'status',
        'order_date',
        'expected_date',
        'received_date',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'currency',
        'notes',
        'created_by',
        'approved_by'
    ];


    static function getPurchaseOrder()
    {
        return self::select('*')->orderBy('id', 'DESC')->paginate(10);
    }

    static function singlePurchaseOrder($id)
    {
        return self::find($id);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    public static function generateCode()
    {
        
    }
}
