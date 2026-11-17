@extends('admin.layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/admin/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">

@endsection
@section('content')
    @include('admin.include.messages_alert')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
							<img src="{{asset($setting->logo)}}" class="my-auto ht-xl-70p mx-auto" alt="{{$setting->title}}">
						</div>
					</div>
				</div>
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{route('admin.dashboard')}}"><img src="{{asset($setting->logo)}}" class="sign-favicon ht-40" alt="{{$setting->title}}"></a><h1 class="main-logo1 ml-1 mr-2 my-auto tx-28">{{$setting->title}}</h1></div>
										<div class="card-sigin">
											<div class="main-signup-header">
												<h2>{{__('general.welcome back')}}</h2>

                                                <!-- Login User  -->
                                                <div class="" id="user">
                                                    <form method="POST" action="{{ route('login') }}">
                                                        @csrf
                                                        <h5 class="font-weight-semibold mb-4">{{__('auth.sign-user')}}</h5>
                                                        @if($errors->any())
                                                            <div class="alert alert-danger mb-0">
                                                                <ul>
                                                                    @foreach($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
													    <div class="form-group">
													    	<label>{{__('auth.email')}}</label> <input class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" >
													    </div>
													    <div class="form-group">
													    	<label>{{__('auth.password')}}</label> <input class="form-control" placeholder="Enter your password" type="password" name="password" required autocomplete="current-password">
													    </div><button class="btn btn-main-primary btn-block">{{__('auth.sign in')}}</button>
												    </form>
                                                </div>

                                                <!-- Login Admin  -->
                                                <div class="loginForm" id="admin">
                                                    <form method="POST" action="{{ route('admin.login') }}">
                                                        @csrf
                                                        <h5 class="font-weight-semibold mb-4">{{__('auth.sign-admin')}}</h5>
													    <div class="form-group">
													    	<label>{{__('auth.email')}}</label> <input class="form-control" placeholder="Enter your email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" >
													    </div>
													    <div class="form-group">
													    	<label>{{__('auth.password')}}</label> <input class="form-control" placeholder="Enter your password" type="password" name="password" required autocomplete="current-password">
													    </div><button class="btn btn-main-primary btn-block">{{__('auth.sign in')}}</button>
												    </form>
                                                </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->
			</div>
		</div>
@endsection
@section('js')

@endsection
