@extends('admin.two-factor.layout')
@section('title', __('admin/two_factor.setup-title'))
@section('content')
    <h1>{{ __('admin/two_factor.setup-title') }}</h1>
    <p>{{ __('admin/two_factor.setup-intro') }}</p>

    <p>1. {{ __('admin/two_factor.step-install') }}</p>
    <p>2. {{ __('admin/two_factor.step-scan') }}</p>

    <div class="qr">{!! $qr !!}</div>
    <div class="key">{{ $secret }}</div>

    <p style="margin-top: 16px;">3. {{ __('admin/two_factor.step-code') }}</p>

    <form method="POST" action="{{ route('admin.two-factor.confirm') }}" autocomplete="off">
        @csrf
        <input type="text" name="code" inputmode="numeric" maxlength="20" autocomplete="one-time-code" autofocus required>
        @error('code')
        <div class="error">{{ $message }}</div>
        @enderror

        <label class="check">
            <input type="checkbox" name="remember" value="1">
            {{ __('admin/two_factor.remember', ['days' => config('two_factor.remember_days')]) }}
        </label>

        <button class="btn" type="submit">{{ __('admin/two_factor.confirm') }}</button>
    </form>
@endsection
