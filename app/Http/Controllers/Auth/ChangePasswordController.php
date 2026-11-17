<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\TwoFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        $header_title = __('admin/password.title');

        return view('admin.password.change', compact('header_title'));
    }

    public function update(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        if (Hash::check($request->password, $admin->password)) {
            return redirect()->back()
                ->withErrors(['password' => __('admin/password.same-as-old')]);
        }

        $admin->password = Hash::make($request->password);
        $admin->must_change_password = false;
        $admin->save();

        // السطر الجديد: إلغاء كل الأجهزة المتذكّرة بعد تغيير كلمة السر
        app(TwoFactorService::class)->revokeDevices($admin);

        session()->flash('true');

        // الأدمن الافتراضي (id = 1) يكمل لصفحة الإعدادات
        return $admin->id === 1
            ? redirect()->route('admin.general.setting')
            : redirect()->route('admin.dashboard');
    }
}
