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
    <form action="{{route('admin.account.postRegister')}}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="card-title tx-white mb-1">{{$header_title}}</h4>
                    </div>
                    <!-- Begin Form Basic Data  -->
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="custom-file form-group">
                                    <input class="custom-file-input" id="customFile" type="file" name="photo"> <label class="custom-file-label" for="customFile">{{__('admin/body.chose photo')}}</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/sidebar.branches')}}</label>
                                <select class="SlectBox form-control" name="branch_id">
                                    <option disabled selected>{{__('admin/body.chose cat')}}</option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select>
                                @error('branch_id')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/sidebar.warehouse')}}</label>
                                <select class="SlectBox form-control" name="warehouse_id">
                                    <option disabled selected>{{__('admin/sidebar.warehouse')}}</option>
                                    @foreach($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                                        @endforeach
                                </select>
                                @error('warehouse_id')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.name')}}</label>
                                <input type="text" class="form-control" id="inputName" name="name" value="{{old('name')}}">
                                @error('name')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('auth.email')}}</label>
                                <input type="email" class="form-control" id="inputName" name="email" value="{{old('email')}}">
                                @error('email')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.phone')}}</label>
                                <input type="text" class="form-control" id="inputName" name="phone">
                                @error('phone')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('auth.password')}}</label>
                                <input type="password" class="form-control" id="inputName" name="password">
                                @error('password')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/sidebar.roles')}}</label>
                                <select class="SlectBox form-control" name="role">
                                    <option disabled selected>{{__('admin/sidebar.roles')}}</option>
                                    @foreach($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('auth.national_id')}}</label>
                                <input type="text" class="form-control" id="inputName" name="national_id">
                                @error('national_id')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.birthday')}}</label>
                                <input type="date" class="form-control" id="inputName" name="birth_date">
                                @error('birth_date')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.gender')}}</label>
                                <select class="SlectBox form-control" name="gender">
                                    <option disabled selected>{{__('admin/body.gender')}}</option>
                                    <option value="male">{{__('admin/body.male')}}</option>
                                    <option value="female">{{__('admin/body.female')}}</option>
                                </select>
                                @error('gender')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('auth.emergency_contact')}}</label>
                                <input type="text" class="form-control" id="inputName" name="emergency_contact">
                                @error('emergency_contact')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('auth.hire_date')}}</label>
                                <input type="date" class="form-control" id="inputName" name="hire_date">
                                @error('hire_date')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.salary')}}</label>
                                <input type="text" class="form-control" id="inputName" name="salary">
                                @error('salary')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.address')}}</label>
                                <input type="text" class="form-control" id="inputName" name="address">
                                @error('address')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.notes')}}</label>
                                <input type="text" class="form-control" id="inputName" name="notes">
                                @error('notes')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <script type="prismsmix/javascript"></script>
                            <div class="col-md-4">
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

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/admin/js/select2.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/admin/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/admin/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/notify/js/notifit-custom.js')}}"></script>


@endsection
