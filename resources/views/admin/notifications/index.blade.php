@extends('admin.layouts.master')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
{{--            <h5 class="mb-0"> {{ __('notifications.all-title') }}</h5>--}}
            <h4 class="card-title mg-b-0">{{__('general.all')}} {{$header_title}}</h4>
            @if($unreadCount > 0)
                <form action="{{ route('admin.account.notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-primary">
                        {{ __('notifications.mark-all-read') }}
                    </button>
                </form>
            @endif
        </div>

        <div class="list-group list-group-flush">
            @forelse($notifications as $notification)
                @php
                    $typeConfig = config('notification_types.' . ($notification->data['type'] ?? 'default'), config('notification_types.default'));
                @endphp

                <a href="{{ route('admin.account.notifications.read', $notification->id) }}"
                   class="list-group-item list-group-item-action d-flex p-3 notifyimg {{ $notification->read_at ? '' : 'bg-light' }}" style="align-items: center">
                    <div class="notifyimg {{ $typeConfig['color'] }}">
                        <i class="la {{ $typeConfig['icon'] }} text-white"></i>
                    </div>

                    <div class="notif-text-start-10px">
                        <h5 class="notification-label mb-1">
                            {{ __($notification->data['title_key']) }}
                            @unless($notification->read_at)
                                <span class="badge badge-pill badge-warning">{{ __('notifications.new') }}</span>
                            @endunless
                        </h5>
                        <div class="notification-subtext">
                            {{ __($notification->data['body_key'], $notification->data['body_params'] ?? []) }}
                        </div>
                        <div class="notification-subtext">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                </a>
            @empty
                <div class="p-4 text-center text-muted">{{ __('notifications.empty') }}</div>
            @endforelse
        </div>

        <div class="card-footer">
            {{ $notifications->links() }}
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    @endsection
