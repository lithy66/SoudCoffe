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
                    <div class="d-flex my-xl-auto right-content">
                        <div class="pr-1 mb-3 mb-xl-0">
                            <a href="{{route('admin.warehouse.add')}}" class="btn btn-primary btn-with-icon btn-block">{{__('general.add')}}<span class="material-symbols-outlined" style="margin-right: 5px">add_task</span></a>
                        </div>
                    </div>
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
                                    <div class="d-flex justify-content-center">
                                        <span class="material-symbols-outlined custom-icon">warehouse</span>
                                        <h4 class="card-title mg-b-0">{{__('general.all').' '.__('admin/sidebar.storage')}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.name')}}</th>
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.address')}}</th>
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.manager')}}</th>
                                            <th class="wd-15p border-bottom-0">{{__('admin/sidebar.branches')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('general.type')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.phone')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.status')}}</th>
                                            <th class="wd-15p border-bottom-0">{{__('general.create-d')}}</th>
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($warehouse as $value)

                                            <tr class="@if($value->is_active == 0) bg-danger-transparent @endif">
                                                <td><a data-toggle="modal" data-effect="effect-flip-vertical" href="#show{{$value->id}}">{{$value->name}}</a></td>
                                                <td>{{\Str::limit($value->address, 20)}}</td>
                                                <td>{{$value->admin->name}}</td>
                                                <td>{{($value->branch_id == null)? '--' : $value->branch->name}}</td>
                                                <td>@if($value->type == 'main')
                                                    {{__('admin/body.main')}}
                                                        @elseif($value->type == 'branch')
                                                        {{__('admin/sidebar.branches')}}
                                                        @else
                                                        {{__('admin/body.online')}}
                                                    @endif</td>
                                                <td>{{$value->phone}}</td>
                                                <td>{{$value->getActive()}}</td>
                                                <td>{{$value->created_at->diffForHumans()}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{__('admin/body.action')}}<i class="fas fa-caret-down notif-text-start"></i></button>
                                                        <div class="dropdown-menu tx-13">
                                                            <a class="dropdown-item" href="{{route('admin.warehouse.edit',$value->id)}}"><i style="color: #0ba360" class="text-success ti-reload"></i>&nbsp;&nbsp; {{__('general.edit')}}</a>
                                                            <a class="dropdown-item" href="#update_status{{$value->id}}" data-toggle="modal" data-target=""><i class="text-warning ti-back-right"></i>&nbsp;&nbsp;{{__('general.edit').' '.__('admin/body.status') }} </a>
                                                            <a class="dropdown-item" href="#delete{{$value->id}}" data-toggle="modal"><i class="text-danger ti-trash"></i>&nbsp;&nbsp; {{__('general.delete')}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('admin.warehouse.delete')
                                            @include('admin.warehouse.show')
                                            @include('admin.warehouse.update_status')
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
