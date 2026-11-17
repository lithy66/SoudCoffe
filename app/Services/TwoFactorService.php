<?php

namespace App\Services;

use App\Models\Admin;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorService
{
    public function __construct(protected Google2FA $google2fa) {}

/** توليد مفتاح جديد (غير مفعّل لحد ما يتأكد بكود صحيح) */
    public function generateSecret(Admin $admin): void
    {
        $admin->forceFill([
            'two_factor_secret' => $this->google2fa->generateSecretKey(),
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
            'two_factor_last_timestamp' => null,
        ])->save();
    }

    /** صورة الـ QR كـ SVG
     * @param Admin $admin
     * @return string
     */
    public function qrCodeSvg(Admin $admin): string
    {
        $url = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $admin->email,
            $admin->two_factor_secret
        );

        $writer = new Writer(new ImageRenderer(new RendererStyle(200, 1), new SvgImageBackEnd()));
        $svg = $writer->writeString($url);

        // شيل سطر <?xml ...> الأول عشان يتحط جوه HTML
        return trim(substr($svg, strpos($svg, "\n") + 1));
    }

    /** التحقق من رمز التطبيق، مع منع إعادة استخدام نفس الرمز
     * @param Admin $admin
     * @param string $code
     * @return bool
     */
    public function verify(Admin $admin, string $code): bool
    {
        $code = preg_replace('/\s+/', '', $code);

        $timestamp = $this->google2fa->verifyKeyNewer(
            $admin->two_factor_secret,
            $code,
            $admin->two_factor_last_timestamp ?? 0
        );

        if ($timestamp === false) {
            return false;
        }

        $admin->forceFill(['two_factor_last_timestamp' => $timestamp])->save();

        return true;
    }

    public function generateRecoveryCodes(Admin $admin): array
    {
        $codes = collect(range(1, config('two_factor.recovery_codes', 8)))
            ->map(fn () => Str::lower(Str::random(5) . '-' . Str::random(5)))
            ->all();

        $admin->forceFill(['two_factor_recovery_codes' => $codes])->save();

        return $codes;
    }

    /** رمز الاسترداد بيتستخدم مرة واحدة وبيتمسح
     * @param Admin $admin
     * @param string $input
     * @return bool
     */
    public function useRecoveryCode(Admin $admin, string $input): bool
    {
        $input = Str::lower(trim($input));
        $codes = $admin->two_factor_recovery_codes ?? [];

        if (!in_array($input, $codes, true)) {
            return false;
        }

        $admin->forceFill([
            'two_factor_recovery_codes' => array_values(array_diff($codes, [$input])),
        ])->save();

        return true;
    }

    /** تسجيل الجهاز الحالي كجهاز موثوق
     * @param Request $request
     * @param Admin $admin
     */
    public function trustDevice(Request $request, Admin $admin): void
    {
        $days = config('two_factor.remember_days', 30);
        $token = Str::random(64);

        $admin->trustedDevices()->where('expires_at', '<', now())->delete();

        $agent = new Agent();
        $agent->setUserAgent((string) $request->userAgent());

        $admin->trustedDevices()->create([
            'token_hash'   => hash('sha256', $token),
            'device_name'  => trim($agent->browser() . ' - ' . $agent->platform(), ' -'),
            'ip_address'   => $request->ip(),
            'last_used_at' => now(),
            'expires_at'   => now()->addDays($days),
        ]);

        Cookie::queue(
            config('two_factor.cookie'),
            $token,
            $days * 24 * 60,
            null,
            null,
            $request->isSecure(),
            true,
            false,
            'lax'
        );
    }

    public function isTrustedDevice(Request $request, Admin $admin): bool
    {
        $token = $request->cookie(config('two_factor.cookie'));

        if (!$token || !is_string($token)) {
            return false;
        }

        $device = $admin->trustedDevices()
            ->where('token_hash', hash('sha256', $token))
            ->where('expires_at', '>', now())
            ->first();

        if (!$device) {
            return false;
        }

        $device->update(['last_used_at' => now()]);

        return true;
    }

    /** إلغاء كل الأجهزة المتذكّرة (تغيير الباسورد أو تصفير 2FA)
     * @param Admin $admin
     */
    public function revokeDevices(Admin $admin): void
    {
        $admin->trustedDevices()->delete();
    }
}

