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

    <!-- row -->
    <form action="{{route('admin.warehouse.update', $warehouse)}}" method="post" autocomplete="off">
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
                            <input type="hidden" name="id" value="{{$warehouse->id}}">
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.manager')}}</label>
                                <select class="SlectBox form-control" name="admin_id">
                                    <option disabled selected>{{__('admin/body.chose')}}</option>
                                    @foreach($admins as $admin)
                                        <option value="{{$admin->id}}" @if($warehouse->admin_id == $admin->id) selected @endif>{{$admin->name}}</option>
                                    @endforeach
                                </select>
                                @error('admin_id')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('general.type')}}</label>
                                <select class="SlectBox form-control" name="type" id="type">
                                    <option disabled selected>{{__('general.type')}}</option>
                                    <option value="main" @if($warehouse->type == 'main') selected @endif>{{__('admin/body.main')}}</option>
                                    <option value="branch" @if($warehouse->type == 'branch') selected @endif>{{__('admin/sidebar.branches')}}</option>
                                    <option value="online" @if($warehouse->type == 'online') selected @endif>{{__('admin/body.online')}}</option>
                                </select>
                                @error('type')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6" @if($warehouse->branch_id == null) style="display: none" @endif id="branch">
                                <label for="projectinput1">{{__('admin/sidebar.branches')}}</label>
                                <select class="SlectBox form-control" name="branch_id">
                                    <option disabled selected>{{__('admin/sidebar.branches')}}</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}" @if($warehouse->branch_id == $branch->id) selected @endif>{{$branch->name}}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.phone')}}</label>
                                <input type="text" class="form-control" id="inputName" name="phone" value="{{$warehouse->phone}}">
                                @error('phone')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
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
                                                    <input type="text" class="form-control" id="inputName" name="{{$key}}[name]" value="{{$warehouse->translate($key)->name}}" >
                                                    @error($key.'*.name')
                                                    <span class="alert text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="projectinput1">{{__('admin/body.address')}}</label>
                                                    <textarea class="form-control" id="inputName" name="{{$key}}[address]" >{{$warehouse->translate($key)->address}}</textarea>
                                                    @error($key.'*.address')
                                                    <span class="alert text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <label for="projectinput1">{{__('admin/body.notes')}}</label>
                                                    <textarea class="form-control" id="inputName" name="{{$key}}[notes]" >{{$warehouse->translate($key)->notes}}</textarea>
                                                    @error($key.'*.notes')
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
        $(document).on('change', '#type', function () {
            if($(this).val() == 'branch')
            {
                $('#branch').show();
            }else {
                $('#branch').hide();
            }
        });
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
