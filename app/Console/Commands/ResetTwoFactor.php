<?php

namespace App\Console\Commands;

use App\Models\Admin;
use App\Services\TwoFactorService;
use Illuminate\Console\Command;

class ResetTwoFactor extends Command
{
    protected $signature = 'admin:reset-2fa {email}';

    protected $description = 'Reset two-factor authentication for an admin';

    public function handle(TwoFactorService $twoFactor): int
    {
        $admin = Admin::where('email', $this->argument('email'))->first();

        if (!$admin) {
            $this->error('Admin not found');
            return self::FAILURE;
        }

        $admin->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
            'two_factor_last_timestamp' => null,
        ])->save();

        $twoFactor->revokeDevices($admin);

        $this->info('Done. The admin will set up two-factor authentication at the next login.');

        return self::SUCCESS;
    }
}
