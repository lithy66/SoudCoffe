<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    use HasFactory, SoftDeletes;

    public const STATUS_DRAFT              = 'draft';
    public const STATUS_SENT               = 'sent';
    public const STATUS_PARTIALLY_RECEIVED = 'partially_received';
    public const STATUS_RECEIVED           = 'received';
    public const STATUS_CANCELLED          = 'cancelled';

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_SENT,
        self::STATUS_PARTIALLY_RECEIVED,
        self::STATUS_RECEIVED,
        self::STATUS_CANCELLED,
    ];

    protected $fillable = [
        'po_number', 'supplier_id', 'warehouse_id', 'status',
        'order_date', 'expected_date', 'received_date',
        'subtotal', 'tax_amount', 'discount_amount', 'total_amount',
        'currency', 'notes', 'created_by', 'approved_by', 'approved_at',
    ];

    protected $casts = [
        'order_date'      => 'date',
        'expected_date'   => 'date',
        'received_date'   => 'date',
        'approved_at'     => 'datetime',
        'subtotal'        => 'decimal:2',
        'tax_amount'      => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount'    => 'decimal:2',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function creator()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function approver()
    {
        return $this->belongsTo(Admin::class, 'approved_by');
    }

    public function items()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    /** التعديل مسموح في المسودة بس */
    public function isEditable(): bool
    {
        return $this->status === self::STATUS_DRAFT;
    }

    /** رقم الأمر: PO-2026-00001 */
    public static function generateNumber(): string
    {
        $year = now()->year;
        $last = static::withTrashed()
            ->where('po_number', 'like', "PO-$year-%")
            ->orderByDesc('id')
            ->value('po_number');

        $next = $last ? ((int) substr($last, -5)) + 1 : 1;

        return sprintf('PO-%d-%05d', $year, $next);
    }
}
