<!-- main-header opened -->
			<div class="main-header sticky side-header nav nav-item">
				<div class="container-fluid">
					<div class="main-header-left ">
						<div class="responsive-logo">
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/admin/img/brand/logo.png')}}" class="logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/admin/img/brand/logo-white.png')}}" class="dark-logo-1" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/admin/img/brand/favicon.png')}}" class="logo-2" alt="logo"></a>
							<a href="{{ url('/' . $page='index') }}"><img src="{{URL::asset('assets/admin/img/brand/favicon.png')}}" class="dark-logo-2" alt="logo"></a>
						</div>
						<div class="app-sidebar__toggle" data-toggle="sidebar">
							<a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
							<a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
						</div>
						<div class="main-header-center mr-3 d-sm-none d-md-none d-lg-block">
							<input class="form-control" placeholder="Search for anything..." type="search"> <button class="btn"><i class="fas fa-search d-none d-md-block"></i></button>
						</div>
					</div>
					<div class="main-header-right">
						<ul class="nav">
							<li class="">
								<div class="dropdown  nav-itemd-none d-md-flex">
									<a href="#" class="d-flex  nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
                                        @if(app()->getLocale() === 'ar')
										<span class="avatar country-Flag mr-0 align-self-center bg-transparent">
                                            <img src="{{URL::asset('assets/admin/img/flags/egypt_flag.jpg')}}" alt="img">
                                        </span>
										<div class="my-auto">
											<strong class="mr-2 ml-2 my-auto">العربيه</strong>
										</div>
                                        @else
                                        <span class="avatar country-Flag mr-0 align-self-center bg-transparent">
                                            <img src="{{URL::asset('assets/admin/img/flags/us_flag.jpg')}}" alt="img">
                                        </span>
                                        <div class="my-auto">
                                            <strong class="mr-2 ml-2 my-auto">English</strong>
                                        </div>
                                            @endif
									</a>
									<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
										<a hreflang="{{$localeCode}}" href="{{LaravelLocalization::getLocalizedURL($localeCode, null, [], true)}}" class="dropdown-item d-flex ">
											<span class="avatar  ml-3 align-self-center bg-transparent">@if($loop->index == 0)<img src="{{URL::asset('assets/admin/img/flags/us_flag.jpg')}}" alt="img">
                                            @else
                                                    <img src="{{URL::asset('assets/admin/img/flags/egypt_flag.jpg')}}" alt="img">
                                                                                                            @endif
                                            </span>
											<div class="d-flex">
												<span class="mt-2">{{$properties['native']}}</span>
											</div>
										</a>
                                        @endforeach
									</div>
								</div>
							</li>
						</ul>
						<div class="nav nav-item  navbar-nav-right ml-auto">
							<div class="nav-link" id="bs-example-navbar-collapse-1">
								<form class="navbar-form" role="search">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search">
										<span class="input-group-btn">
											<button type="reset" class="btn btn-default">
												<i class="fas fa-times"></i>
											</button>
											<button type="submit" class="btn btn-default nav-link resp-btn">
												<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
											</button>
										</span>
									</div>
								</form>
							</div>
{{--							<div class="dropdown nav-item main-header-message ">--}}
{{--								<a class="new nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span class=" pulse-danger"></span></a>--}}
{{--								<div class="dropdown-menu">--}}
{{--									<div class="menu-header-content bg-primary text-right">--}}
{{--										<div class="d-flex">--}}
{{--											<h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">Messages</h6>--}}
{{--											<span class="badge badge-pill badge-warning mr-auto my-auto float-left">Mark All Read</span>--}}
{{--										</div>--}}
{{--										<p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12 ">You have 4 unread messages</p>--}}
{{--									</div>--}}
{{--									<div class="main-message-list chat-scroll">--}}
{{--										<a href="#" class="p-3 d-flex border-bottom">--}}
{{--											<div class="  drop-img  cover-image  " data-image-src="{{URL::asset('assets/admin/img/faces/3.jpg')}}">--}}
{{--												<span class="avatar-status bg-teal"></span>--}}
{{--											</div>--}}
{{--											<div class="wd-90p">--}}
{{--												<div class="d-flex">--}}
{{--													<h5 class="mb-1 name">Petey Cruiser</h5>--}}
{{--												</div>--}}
{{--												<p class="mb-0 desc">I'm sorry but i'm not sure how to help you with that......</p>--}}
{{--												<p class="time mb-0 text-left float-right mr-2 mt-2">Mar 15 3:55 PM</p>--}}
{{--											</div>--}}
{{--										</a>--}}
{{--										<a href="#" class="p-3 d-flex border-bottom">--}}
{{--											<div class="drop-img cover-image" data-image-src="{{URL::asset('assets/admin/img/faces/2.jpg')}}">--}}
{{--												<span class="avatar-status bg-teal"></span>--}}
{{--											</div>--}}
{{--											<div class="wd-90p">--}}
{{--												<div class="d-flex">--}}
{{--													<h5 class="mb-1 name">Jimmy Changa</h5>--}}
{{--												</div>--}}
{{--												<p class="mb-0 desc">All set ! Now, time to get to you now......</p>--}}
{{--												<p class="time mb-0 text-left float-right mr-2 mt-2">Mar 06 01:12 AM</p>--}}
{{--											</div>--}}
{{--										</a>--}}
{{--										<a href="#" class="p-3 d-flex border-bottom">--}}
{{--											<div class="drop-img cover-image" data-image-src="{{URL::asset('assets/admin/img/faces/9.jpg')}}">--}}
{{--												<span class="avatar-status bg-teal"></span>--}}
{{--											</div>--}}
{{--											<div class="wd-90p">--}}
{{--												<div class="d-flex">--}}
{{--													<h5 class="mb-1 name">Graham Cracker</h5>--}}
{{--												</div>--}}
{{--												<p class="mb-0 desc">Are you ready to pickup your Delivery...</p>--}}
{{--												<p class="time mb-0 text-left float-right mr-2 mt-2">Feb 25 10:35 AM</p>--}}
{{--											</div>--}}
{{--										</a>--}}
{{--										<a href="#" class="p-3 d-flex border-bottom">--}}
{{--											<div class="drop-img cover-image" data-image-src="{{URL::asset('assets/admin/img/faces/12.jpg')}}">--}}
{{--												<span class="avatar-status bg-teal"></span>--}}
{{--											</div>--}}
{{--											<div class="wd-90p">--}}
{{--												<div class="d-flex">--}}
{{--													<h5 class="mb-1 name">Donatella Nobatti</h5>--}}
{{--												</div>--}}
{{--												<p class="mb-0 desc">Here are some products ...</p>--}}
{{--												<p class="time mb-0 text-left float-right mr-2 mt-2">Feb 12 05:12 PM</p>--}}
{{--											</div>--}}
{{--										</a>--}}
{{--										<a href="#" class="p-3 d-flex border-bottom">--}}
{{--											<div class="drop-img cover-image" data-image-src="{{URL::asset('assets/admin/img/faces/5.jpg')}}">--}}
{{--												<span class="avatar-status bg-teal"></span>--}}
{{--											</div>--}}
{{--											<div class="wd-90p">--}}
{{--												<div class="d-flex">--}}
{{--													<h5 class="mb-1 name">Anne Fibbiyon</h5>--}}
{{--												</div>--}}
{{--												<p class="mb-0 desc">I'm sorry but i'm not sure how...</p>--}}
{{--												<p class="time mb-0 text-left float-right mr-2 mt-2">Jan 29 03:16 PM</p>--}}
{{--											</div>--}}
{{--										</a>--}}
{{--									</div>--}}
{{--									<div class="text-center dropdown-footer">--}}
{{--										<a href="text-center">VIEW ALL</a>--}}
{{--									</div>--}}
{{--								</div>--}}
{{--							</div>--}}
                            <!-- Notifications -->

							<div class="dropdown nav-item main-header-notification">
                                <a class="new nav-link position-relative" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                                    @if($unreadNotificationsCount > 0)
                                        <span class="notif-badge">
                                            {{ $unreadNotificationsCount > 9 ? '9+' : $unreadNotificationsCount }}
                                        </span>
                                    @endif
                                </a>
                                {{--                                    <span class="pulse"></span>--}}
								<div class="dropdown-menu">
									<div class="menu-header-content bg-primary text-right">
                                        <div class="d-flex">
                                            <h6 class="dropdown-title mb-1 tx-15 text-white font-weight-semibold">{{ __('notifications.panel-title') }}</h6>
                                            @if($unreadNotificationsCount > 0)
                                                <form action="{{ route('admin.account.notifications.mark-all-read') }}" method="POST" class="mr-auto">
                                                    @csrf
                                                    <button type="submit" class="badge badge-pill badge-warning my-auto float-left border-0">
                                                        {{ __('notifications.mark-all-read') }}
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        <p class="dropdown-title-text subtext mb-0 text-white op-6 pb-0 tx-12">
                                            {{ __('notifications.unread-count', ['count' => $unreadNotificationsCount]) }}
                                        </p>
									</div>
                                    <div class="main-notification-list Notification-scroll">
                                        @forelse($headerNotifications as $notification)
                                            @php
                                                $typeConfig = config('notification_types.' . ($notification->data['type'] ?? 'default'), config('notification_types.default'));
                                            @endphp
                                            <a class="d-flex p-3 border-bottom" href="{{ route('admin.account.notifications.read', $notification->id) }}" style="align-items: center">
                                                <div class="notifyimg {{ $typeConfig['color'] }}">
                                                    <i class="la {{ $typeConfig['icon'] }} text-white"></i>
                                                </div>
                                                <div class="notif-text">
                                                    <h5 class="notification-label mb-1">{{ __($notification->data['title_key']) }}</h5>
                                                    <div class="notification-subtext">{{ __($notification->data['body_key'], $notification->data['body_params'] ?? []) }}</div>
                                                    <div class="notification-subtext">{{ $notification->created_at->diffForHumans() }}</div>
                                                </div>
{{--                                                <div class="notif-text">--}}
                                                <div class=" @if (app()->getLocale() === 'en') ml-auto @else mr-auto  @endif ">
                                                    <i class="las @if(app()->getLocale() === 'ar') la-angle-left text-left @else la-angle-right text-right @endif text-muted"></i>
                                                </div>
                                            </a>
                                        @empty
                                            <div class="p-3 text-center text-muted">{{ __('notifications.empty') }}</div>
                                        @endforelse
                                    </div>
                                    <div class="dropdown-footer">
                                        <a href="{{ route('admin.account.notifications.index') }}">{{ __('notifications.view-all') }}</a>
                                    </div>
								</div>
							</div>
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="{{auth('admin')->user()->name}}" @if(empty(auth('admin')->user()->image->filename)) src="{{ URL::asset('assets/admin/img/faces/6.jpg')}}"
                                                                                    @else
                                                                                    src="{{asset(auth('admin')->user()->image->filename)}}"
                                                                                    @endif></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" @if(empty(auth('admin')->user()->image->filename)) src="{{ URL::asset('assets/admin/img/faces/6.jpg')}}"
                                                                                    @else
                                                                                    src="{{asset(auth('admin')->user()->image->filename)}}"
                                                                                    @endif class=""></div>
											<div class="mr-3 my-auto" style="margin-left: 5px">
												<h6>{{auth('admin')->user()->name}}</h6><span>{{auth('admin')->user()->role}}</span>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>Profile</a>
									<a class="dropdown-item" href="{{route('admin.account.profileEdit', auth('admin')->user()->id)}}"><span class="material-symbols-outlined custom-icon">manage_accounts</span>{{__('auth.edit profile')}}</a>
                                    @can('view-roles')
									<a class="dropdown-item" href="{{route('admin.account.register')}}"><span class="material-symbols-outlined custom-icon">person_add</span>{{__('auth.reg')}}</a>
									<a class="dropdown-item" href="{{route('admin.roles.index')}}"><i class="ti-lock sidemenu-icon custom-icon"></i>{{ __('admin/sideBar.roles') }}</a>
									<a class="dropdown-item" href="{{route('admin.account.admin-list')}}"><i class="las la-users custom-icon"></i>{{__('general.administration').' '.__('admin/sideBar.account')}}</a>
                                    @endcan
                                    <form method="post" action="{{route('admin.account.logout')}}">
                                        @csrf
									<a class="dropdown-item" href="route('admin.account.logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="bx bx-log-out"></i>{{__('auth.sign out')}}</a>
                                    </form>
								</div>
							</div>
							<div class="dropdown main-header-message right-toggle">
								<a class="nav-link pr-0" data-toggle="sidebar-left" data-target=".sidebar-left">
									<svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- /main-header -->
