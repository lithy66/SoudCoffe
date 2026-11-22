<?php

namespace App\Models;

use App\Events\AdminRoleAssigned;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable, HasRoles;

    protected $fillable = ['name', 'email','phone', 'password', 'role', 'branch_id', 'warehouse_id', 'is_active', 'last_seen_at'];

    protected $hidden = ['password', 'remember_token', 'two_factor_secret', 'two_factor_recovery_codes'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_seen_at' => 'datetime',
        'is_active' => 'boolean',
        'must_change_password' => 'boolean',
        'two_factor_secret' => 'encrypted',
        'two_factor_recovery_codes' => 'encrypted:array',
        'two_factor_confirmed_at' => 'datetime',
    ];

    protected $guard_name = 'admin';

    static public function getAdmin()
    {
        return self::select('*')->orderBy('id', 'DESC')->paginate(10);
    }

    static public function singleAdmin($id)
    {
        return self::find($id);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1)->orderBy('id', 'DESC')->get();
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('role', $type);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function trustedDevices()
    {
        return $this->hasMany(AdminTrustedDevice::class);
    }

    public function requiresTwoFactor(): bool
    {
        return $this->hasAnyRole(config('two_factor.required_roles', []));
    }

    public function hasConfirmedTwoFactor(): bool
    {
        return !is_null($this->two_factor_confirmed_at);
    }

    public static function checkAdmin(){
        $admin = self::all();
        if (count($admin) < 1){
            $data = [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'info@soud.com',
                'phone' => '0109298493',
                'role' => 'admin',
                'password' => Hash::make('123456'),
                'must_change_password' => true,
            ];
            $newAdmin = self::create($data);
            $newAdmin->assignRole('admin');
            AdminRoleAssigned::dispatch($newAdmin, 'admin');
        }
        return self::first();
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function getOnlineStatusAttribute()
    {
        if ($this->isOnline())
        {
            return __('admin/body.online');
        }

        if (!$this->last_seen_at)
        {
            return __('admin/body.never');
        }
        return $this->last_seen_at->diffForHumans();
    }
}
