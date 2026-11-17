@extends('admin.layouts.master')
@section('css')
<!-- Internal Select2 css -->
<link href="{{URL::asset('assets/admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<!--Internal  Datetimepicker-slider css -->
<link href="{{URL::asset('assets/admin/plugins/amazeui-datetimepicker/css/amazeui.datetimepicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/admin/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/admin/plugins/pickerjs/picker.min.css')}}" rel="stylesheet">
<!-- Internal Spectrum-colorpicker css -->
<link href="{{URL::asset('assets/admin/plugins/spectrum-colorpicker/spectrum.css')}}" rel="stylesheet">
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/admin/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/admin/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/admin/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{$header_title}}</h4><a href="{{route('admin.dashboard')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/body.home')}}</a>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
        <form class="form-horizontal" action="{{route('admin.general.setting.update', $setting)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Begin Card Form Basic Data  -->
                <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-dark">
                            <h4 class="card-title tx-white mb-1">{{__('general.basic')}}</h4>
                        </div>
                        <!-- Begin Form Basic Data  -->
                        <div class="card-body" id="master-div">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label>{{__('admin/body.logo')}}</label>
                                    <img src="{{asset($setting->logo)}}" alt="" style="height: 50px">
                                </div>
                                <div class="col-md-6">
                                    <label>{{__('admin/body.favicon')}}</label>
                                    <img src="{{asset($setting->favicon)}}" alt="" style="height: 50px">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input class="custom-file-input" id="customFile" name="logo" type="file" value="{{$setting->logo}}">
                                        <label class="custom-file-label" for="customFile">{{__('admin/body.chose photo')}}</label>
                                        @error('logo')
                                        <span class="alert text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input class="custom-file-input" id="customFile" name="favicon" type="file" value="{{$setting->favicon}}">
                                        <label class="custom-file-label" for="customFile">{{__('admin/body.chose photo')}}</label>
                                        @error('favicon')
                                        <span class="alert text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="projectinput1">{{__('admin/body.fac')}}</label>
                                    <input type="text" class="form-control" id="inputName" name="facebook" value="{{$setting->facebook}}">
                                    @error('facebook')
                                    <span class="alert text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="projectinput1">{{__('admin/body.inst')}}</label>
                                    <input type="text" class="form-control" id="inputName" name="instagram" value="{{$setting->instagram}}">
                                    @error('instagram')
                                    <span class="alert text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="projectinput1">{{__('admin/body.tel')}}</label>
                                    <input type="text" class="form-control" id="inputName" name="phone" value="{{$setting->phone}}">
                                    @error('phone')
                                    <span class="alert text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="projectinput1">{{__('admin/body.mail')}}</label>
                                    <input type="email" class="form-control" id="inputName" name="email" value="{{$setting->email}}">
                                    @error('email')
                                    <span class="alert text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Form Basic Data  -->
                <!-- Begin Card Form Translations Data  -->
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card" id="tabs-style2">
                        <div class="card-header bg-dark">
                            <h4 class="card-title tx-white mb-1">{{__('general.product')}}</h4>
                        </div>
                        <!-- Begin Form Basic Data  -->
                        <div class="card-body">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            @foreach(config('app.languages') as $key=>$lang)
                                                <li><a href="#{{$key}}" class="nav-link @if($loop->index == 0) active @endif" data-toggle="tab">{{$lang}}</a></li>
                                                @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">
                                        @foreach(config('app.languages') as $key=>$lang)
                                            <div class="tab-pane @if($loop->index == 0) active @endif" id="{{$key}}">
                                                <div class="row form-group">
                                                    <div class="col-md-6">
                                                        <label for="projectinput1">{{__('admin/body.title')}}</label>
                                                        <input type="text" class="form-control" id="inputName" name="{{$key}}[title]" placeholder="" value="{{$setting->translate($key)->title}}">
                                                        @error($key.'*.title')
                                                        <span class="alert text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-md-6">
                                                        <label for="projectinput1">{{__('admin/body.content')}}</label>
                                                        <textarea class="form-control" id="basicTextarea" rows="3" name="{{$key}}[content]" >{{$setting->translate($key)->content}}</textarea>
                                                        @error($key.'*.content')
                                                        <span class="alert text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="projectinput1">{{__('admin/body.address')}}</label>
                                                        <textarea class="form-control" id="basicTextarea" rows="3" name="{{$key}}[address]" >{{$setting->translate($key)->address}}</textarea>
                                                        @error($key.'*.address')
                                                        <span class="alert text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <script type="prismsmix/javascript"></script>
                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary">{{__('general.save')}}</button>
                                    <button type="submit" class="btn btn-secondary">{{__('general.cancel')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
					<!--div-->

	 </div>
				<!-- row closed -->
   </div>
			<!-- Container closed -->
</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/admin/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/admin/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/admin/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Select2.min js -->
<script src="{{URL::asset('assets/admin/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal Ion.rangeSlider.min js -->
<script src="{{URL::asset('assets/admin/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>
<!--Internal  jquery-simple-datetimepicker js -->
<script src="{{URL::asset('assets/admin/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js')}}"></script>
<!-- Ionicons js -->
<script src="{{URL::asset('assets/admin/plugins/jquery-simple-datetimepicker/jquery.simple-dtpicker.js')}}"></script>
<!--Internal  pickerjs js -->
<script src="{{URL::asset('assets/admin/plugins/pickerjs/picker.min.js')}}"></script>
<!-- Internal form-elements js -->
<script src="{{URL::asset('assets/admin/js/form-elements.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/admin/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/admin/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/admin/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/admin/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/admin/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/admin/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/admin/plugins/prism/prism.js')}}"></script>

<script>
    function create() {
        const secDiv = document.createElement('div');
        secDiv.className = "row form-group";

        const container = document.getElementById("master-div");
        container.appendChild(secDiv);
    }
</script>
@endsection
