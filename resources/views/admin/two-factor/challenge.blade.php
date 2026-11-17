@extends('admin.two-factor.layout')
@section('title', __('admin/two_factor.challenge-title'))
@section('content')
    <h1>{{ __('admin/two_factor.challenge-title') }}</h1>
    <p>{{ __('admin/two_factor.challenge-text') }}</p>

    <form method="POST" action="{{ route('admin.two-factor.verify') }}" autocomplete="off">
        @csrf
        <input type="text" name="code" inputmode="text" maxlength="20" autocomplete="one-time-code" autofocus required>
        @error('code')
        <div class="error">{{ $message }}</div>
        @enderror

        <label class="check">
            <input type="checkbox" name="remember" value="1">
            {{ __('admin/two_factor.remember', ['days' => config('two_factor.remember_days')]) }}
        </label>

        <button class="btn" type="submit">{{ __('admin/two_factor.verify') }}</button>
    </form>
@endsection
