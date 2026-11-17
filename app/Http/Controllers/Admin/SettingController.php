<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index(){
        $data ['header_title'] = __('admin/sidebar.settings');
        return view('admin.setting.general-setting', $data);
    }

    public function update(SettingRequest $request, Setting $setting){

        $setting->update($request->except('logo', 'favicon', '_token'));
        if ($request->file('logo')){
            $file = $request -> file('logo');
            $filename = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('images/admin'), $filename);
            $path = 'images/admin/'. $filename;
            $setting->update(['logo' => $path]);
        }
        if ($request->file('favicon')){
            $file = $request -> file('favicon');
            $filename = Str::uuid().$file->getClientOriginalName();
            $file->move(public_path('images/admin'), $filename);
            $path = 'images/admin/'. $filename;
            $setting->update(['favicon' => $path]);
        }

        return redirect()->route('admin.dashboard');
    }
}
