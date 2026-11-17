<?php

namespace App\Http\Middleware;

use App\Services\TwoFactorService;
use Closure;
use Illuminate\Http\Request;

class EnsureTwoFactor
{
    public function __construct(protected TwoFactorService $twoFactor) {}

public function handle(Request $request, Closure $next)
{
    $admin = auth('admin')->user();

    if (!$admin || !$admin->requiresTwoFactor() || session('admin_2fa_passed') === $admin->id) {
        return $next($request);
    }

    // صفحات 2FA نفسها والخروج
    if ($request->routeIs('admin.two-factor.*', 'admin.account.logout')) {
        return $next($request);
    }

    // صفحة تغيير كلمة المرور المؤقتة لازم تفضل متاحة قبل 2FA
    if ($admin->must_change_password && $request->routeIs('admin.password.*')) {
        return $next($request);
    }

    // جهاز متذكّر
    if ($admin->hasConfirmedTwoFactor() && $this->twoFactor->isTrustedDevice($request, $admin)) {
        session(['admin_2fa_passed' => $admin->id]);

        return $next($request);
    }

    // افتكر الصفحة المطلوبة عشان نرجعله لها بعد التحقق
    if ($request->isMethod('get') && !$request->expectsJson()) {
        session(['url.intended' => $request->fullUrl()]);
    }

    return redirect()->route(
        $admin->hasConfirmedTwoFactor() ? 'admin.two-factor.challenge' : 'admin.two-factor.setup'
    );
    }
}
