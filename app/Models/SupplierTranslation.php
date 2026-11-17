<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['company_name', 'address', 'notes'];

    public $timestamps = false;
}
