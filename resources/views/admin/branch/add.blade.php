@extends('admin.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->

    <link href="{{URL::asset('assets/admin/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
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

{{--    @include('Dashboard.messages_alert')--}}

    <!-- row -->
<form action="{{route('admin.branch.store')}}" method="post" autocomplete="off">
    @csrf
    <div class="row">
    <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="card-title tx-white mb-1">{{__('general.basic')}}</h4>
            </div>
            <!-- Begin Form Basic Data  -->
            <div class="card-body">
                <div class="row form-group">
                    <div class="col-md-4">
                        <label for="projectinput1">{{__('general.type')}}</label>
                        <select name="type" class="form-control SlectBox">
                            <option value="" selected disabled>------</option>
                            <option value="takeaway">{{__('admin/body.takeaway')}}</option>
                            <option value="kiosk">{{__('admin/body.kiosk')}}</option>
                            <option value="dine_in">{{__('admin/body.dine in')}}</option>
                        </select>
                        @error('type')
                        <span class="alert text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="projectinput1">{{__('admin/body.manager')}}</label>
                        <select name="admin_id" class="form-control SlectBox">
                            <option value="" selected disabled> ------ </option>
                            @foreach($admin as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                        @error('admin_id')
                        <span class="alert text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="projectinput1">{{__('admin/body.phone')}}</label>
                        <input type="text" class="form-control" id="inputName" name="phone" value="{{old('phone')}}">
                        @error('phone')
                        <span class="alert text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6">
                        <label for="projectinput1">{{__('admin/body.open')}}</label>
                        <input type="time" class="form-control" id="inputName" name="open" value="{{old('open')}}">
                        @error('open')
                        <span class="alert text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="projectinput1">{{__('admin/body.close')}}</label>
                        <input type="time" class="form-control" id="inputName" name="close" value="{{old('close')}}">
                        @error('close')
                        <span class="alert text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" name="is_online" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">{{__('admin/body.online')}}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                            <label for="projectinput1">{{__('admin/body.name')}}</label>
                                            <input type="text" class="form-control" id="inputName" value="{{old($key.'.name')}}" name="{{$key}}[name]">
                                            @error($key.'.name')
                                            <span class="alert text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="projectinput1">{{__('admin/body.address')}}</label>
                                            <input type="text" class="form-control" id="inputName" value="{{old($key.'.address')}}" name="{{$key}}[address]">
                                            @error($key.'.address')
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

    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/admin/js/select2.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/admin/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/admin/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/notify/js/notifit-custom.js')}}"></script>


@endsection
