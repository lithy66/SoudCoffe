<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    protected $fillable = [
        'purchase_order_id', 'material_id',
        'ordered_quantity', 'received_quantity',
        'unit_cost', 'total_cost', 'notes',
    ];

    protected $casts = [
        'ordered_quantity'  => 'decimal:3',
        'received_quantity' => 'decimal:3',
        'unit_cost'         => 'decimal:4',
        'total_cost'        => 'decimal:2',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
