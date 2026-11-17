@extends('admin.layouts.master')
@section('css')
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    @include('admin.include.messages_alert')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{$header_title}}</h4><a href="{{route('admin.dashboard')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/body.home')}}</a>
            </div>
        </div>
        @can('create-role')
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{route('admin.roles.add')}}" class="btn btn-primary btn-with-icon btn-block">{{__('general.add')}}<span class="material-symbols-outlined" style="margin-right: 5px">add_task</span></a>
                </div>
            </div>
        @endcan
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- table -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex justify-content-start">
                            <i class="ti-lock sidemenu-icon custom-icon"></i>
                            <h4 class="card-title mg-b-0">{{__('general.all')}} {{$header_title}}</h4>
                        </div>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">{{__('admin/body.name')}}</th>
                                <th class="wd-10p border-bottom-0">{{__('admin/roles.permissions-count')}}</th>
                                <th class="wd-10p border-bottom-0">{{__('admin/roles.admins-count')}}</th>
                                <th class="wd-10p border-bottom-0">{{__('admin/body.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $value)
                                <tr>
                                    <td>{{$value->name}}</td>
                                    <td>{{$value->permissions_count}}</td>
                                    <td>{{$adminCounts[$value->id] ?? 0}}</td>
                                    <td>
                                        @if($value->name === 'admin')
                                            <span class="text-muted tx-12">{{__('admin/roles.protected')}}</span>
                                        @else
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{__('admin/body.action')}}<i class="fas fa-caret-down notif-text-start"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('edit-role')
                                                        <a class="dropdown-item" href="{{route('admin.roles.edit',$value->id)}}"><i style="color: #0ba360" class="text-success ti-reload"></i>&nbsp;&nbsp; {{__('general.edit')}}</a>
                                                    @endcan
                                                    @can('delete-role')
                                                        <a class="dropdown-item" href="#delete{{$value->id}}" data-toggle="modal"><i class="text-danger ti-trash"></i>&nbsp;&nbsp; {{__('general.delete')}}</a>
                                                    @endcan
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @if($value->name !== 'admin')
                                    @include('admin.roles.delete')
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/admin/js/table-data.js')}}"></script>
@endsection
