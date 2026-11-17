<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class TwoFactorController extends Controller
{
    public function __construct(protected TwoFactorService $twoFactor) {}

/* ---------- الإعداد (أول مرة) ---------- */

    public function setup()
    {
        $admin = auth('admin')->user();

        if ($admin->hasConfirmedTwoFactor()) {
            return redirect()->route('admin.dashboard');
        }

        if (!$admin->two_factor_secret) {
            $this->twoFactor->generateSecret($admin);
        }

        return view('admin.two-factor.setup', [
            'qr'     => $this->twoFactor->qrCodeSvg($admin),
            'secret' => $admin->two_factor_secret,
        ]);
    }

    public function confirm(Request $request)
    {
        $admin = auth('admin')->user();

        if ($admin->hasConfirmedTwoFactor() || !$admin->two_factor_secret) {
            return redirect()->route('admin.dashboard');
        }

        $request->validate(['code' => ['required', 'string', 'max:20']]);

        if ($blocked = $this->tooManyAttempts($request, $admin)) {
            return $blocked;
        }

        if (!$this->twoFactor->verify($admin, $request->code)) {
            return $this->fail($request, $admin);
        }

        $admin->forceFill(['two_factor_confirmed_at' => now()])->save();

        session(['recovery_codes_pending' => $this->twoFactor->generateRecoveryCodes($admin)]);

        $this->pass($request, $admin);

        return redirect()->route('admin.two-factor.recovery');
    }

    /* ---------- رموز الاسترداد (تظهر مرة واحدة) ---------- */

    public function recovery()
    {
        $codes = session('recovery_codes_pending');

        if (!$codes) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.two-factor.recovery', compact('codes'));
    }

    public function done()
    {
        session()->forget('recovery_codes_pending');

        return redirect()->intended(route('admin.dashboard'));
    }

    /* ---------- التحقق عند كل دخول ---------- */

    public function challenge()
    {
        $admin = auth('admin')->user();

        if (!$admin->hasConfirmedTwoFactor()) {
            return redirect()->route('admin.two-factor.setup');
        }

        if (session('admin_2fa_passed') === $admin->id) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.two-factor.challenge');
    }

    public function verify(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate(['code' => ['required', 'string', 'max:20']]);

        if ($blocked = $this->tooManyAttempts($request, $admin)) {
            return $blocked;
        }

        $code = trim($request->code);

        // أرقام بس = رمز التطبيق، غير كده = رمز استرداد
        $isTotp = ctype_digit(str_replace(' ', '', $code));

        $valid = $isTotp
            ? $this->twoFactor->verify($admin, $code)
            : $this->twoFactor->useRecoveryCode($admin, $code);

        if (!$valid) {
            return $this->fail($request, $admin);
        }

        $this->pass($request, $admin);

        return redirect()->intended(route('admin.dashboard'));
    }

    /* ---------- مساعدات ---------- */

    protected function throttleKey(Request $request, $admin): string
    {
        return '2fa|' . $admin->id . '|' . $request->ip();
    }

    protected function tooManyAttempts(Request $request, $admin)
    {
        $key = $this->throttleKey($request, $admin);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors([
                'code' => __('messages.too many attempts', ['seconds' => RateLimiter::availableIn($key)]),
            ]);
        }

        return null;
    }

    protected function fail(Request $request, $admin)
    {
        RateLimiter::hit($this->throttleKey($request, $admin), 60);

        return back()->withErrors(['code' => __('admin/two_factor.invalid-code')]);
    }

    protected function pass(Request $request, $admin): void
    {
        RateLimiter::clear($this->throttleKey($request, $admin));

        $request->session()->put('admin_2fa_passed', $admin->id);
        $request->session()->regenerate();

        if ($request->boolean('remember')) {
            $this->twoFactor->trustDevice($request, $admin);
        }
    }
}
