@extends('admin.two-factor.layout')
@section('title', __('admin/two_factor.recovery-title'))
@section('content')
    <h1>{{ __('admin/two_factor.recovery-title') }}</h1>
    <p>{{ __('admin/two_factor.recovery-text') }}</p>

    <div class="codes">
        @foreach($codes as $code)
            <div>{{ $code }}</div>
        @endforeach
    </div>

    <button type="button" class="btn gray noprint" onclick="window.print()">{{ __('admin/two_factor.print') }}</button>

    <form method="POST" action="{{ route('admin.two-factor.done') }}" class="noprint">
        @csrf
        <button class="btn" type="submit">{{ __('admin/two_factor.done') }}</button>
    </form>
@endsection
