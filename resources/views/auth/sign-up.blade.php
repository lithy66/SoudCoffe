@extends('admin.layouts.master2')
@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/admin/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter">
				<!-- The image half -->
				<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
					<div class="row wd-100p mx-auto text-center">
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
{{--							<img src="{{URL::asset('assets/admin/img/photos/doc-sigin.webp')}}" class="my-auto ht-xl-70p mx-auto" alt="logo">--}}
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
										<div class="mb-5 d-flex"> <a href="{{ url('/') }}"><img src="{{asset($setting->logo)}}" class="sign-favicon ht-40" alt="{{$setting->title}}"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28">{{$setting->title}}</h1></div>
										<div class="main-signup-header">
											<h2 class="text-primary">Get Started</h2>
											<h5 class="font-weight-normal mb-4">It's free to signup and only takes a minute.</h5>
											<form method="POST" action="{{route('admin.post.register')}}" >
                                                @csrf
												<div class="form-group">
													<label>{{__('auth.user.n')}}</label> <input class="form-control" placeholder="Enter your firstname and lastname" name="name" type="text" required autofocus autocomplete="name">
												</div>
												<div class="form-group">
													<label>{{__('auth.email')}}</label> <input class="form-control" placeholder="Enter your email" type="email" name="email">
												</div>
												<div class="form-group">
													<label>{{__('auth.password')}}</label> <input class="form-control" placeholder="Enter your password" type="password" name="password">
												</div>
                                                <div class="form-group">
													<label>{{__('auth.password con')}}</label> <input class="form-control" placeholder="Enter your password" type="password" name="password_confirmation" required autocomplete="new-password">
												</div>
                                                <button class="btn btn-main-primary btn-block">{{__('auth.c.account')}}</button>

											</form>
											<div class="main-signup-footer mt-5">
												<p>{{__('auth.f-account')}} <a href="{{ route('login') }}">{{__('auth.sign in')}}</a></p>
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
