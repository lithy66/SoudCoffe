<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'admin_id',
        'national_id',
        'birth_date',
        'gender',
        'address',
        'emergency_contact',
        'hire_date',
        'salary',
        'notes'
    ];

    static function admin($adminID)
    {
        return self::findOrFail('admin_id', $adminID);
    }
}
