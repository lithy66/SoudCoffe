@extends('admin.layouts.master')
@section('css')
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/admin/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
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
                    <div class="d-flex my-xl-auto right-content">
                        <div class="pr-1 mb-3 mb-xl-0">
                            <a href="{{route('admin.branch.add')}}" class="btn btn-primary btn-with-icon btn-block">{{__('general.add')}}<span class="material-symbols-outlined" style="margin-right: 5px">add_task</span></a>
                        </div>
                    </div>
                </div>
				<!-- breadcrumb -->
@endsection
@section('content')
    @include('admin.include.messages_alert')
				<!-- table -->
                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-start">
                                        <span class="material-symbols-outlined custom-icon">gite</span>
                                        <h4 class="card-title mg-b-0">{{__('general.all').' '.$header_title}}</h4>
                                    </div>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.name')}}</th>
                                            <th class="wd-5p border-bottom-0">{{__('admin/body.address')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.manager')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.phone')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.online')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.open')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.close')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('general.type')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.status')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('general.create-d')}}</th>
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($branch as $value)
                                                <tr class="@if($value->is_active == 0) bg-pink-transparent @endif">
                                                    <td> {{$value->name}}</td>
                                                    <td>{{\Str::limit($value->address, 10)}}</td>
                                                    <td>{{$value->admin->name}}</td>
                                                    <td>{{$value->phone}}</td>
                                                    <td>{{ ($value->online == 0)? __('admin/body.true') : __('admin/body.false')}}</td>
                                                    <td>{{$value->open}}</td>
                                                    <td>{{$value->close}}</td>
                                                    <td>{{$value->getType()}}</td>
                                                    <td>{{$value->getActive()}}</td>
                                                    <td>{{date('d-m-Y H:i', strtotime($value->created_at))}}</td>
                                                    <td>
                                                        <div class="btn-icon-list">
                                                            <div class="dropdown">
                                                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{__('admin/body.action')}}<i class="fas fa-caret-down notif-text-start"></i></button>
                                                                <div class="dropdown-menu tx-13">
                                                                    <a class="dropdown-item" href="{{route('admin.branch.edit', $value->id)}}"><i style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp; {{__('general.edit')}}</a>
                                                                    <a class="dropdown-item" href="#update_status{{$value->id}}" data-toggle="modal" data-target=""><i class="text-warning ti-back-right"></i>&nbsp;&nbsp;{{__('general.edit').' '.__('admin/body.status') }} </a>
                                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{$value->id}}"><i   class="text-danger  ti-trash"></i>&nbsp;&nbsp;{{__('general.delete')}}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @include('admin.branch.delete')
                                            @include('admin.branch.update_status')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/div-->

                    <!--div-->

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
    <!--Internal  Notify js -->
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
