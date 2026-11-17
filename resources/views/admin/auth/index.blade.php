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
                        <div class="d-flex" id="test">
                            <h4 class="content-title mb-0 my-auto">{{$header_title}}</h4><a href="{{route('admin.dashboard')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/body.home')}}</a>
                        </div>
                    </div>
                    <div class="d-flex my-xl-auto right-content">
                        <div class="pr-1 mb-3 mb-xl-0">
                            <a href="{{route('admin.account.register')}}" class="btn btn-primary btn-with-icon btn-block">{{__('general.add')}}<span class="material-symbols-outlined" style="margin-right: 5px">add_task</span></a>
                        </div>
                    </div>
                </div>
				<!-- breadcrumb -->
@endsection
@section('content')

				<!-- table -->
                <div class="row row-sm">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 grid-margin">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">{{$header_title}}</h4>
                                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive border-top userlist-table">
                                    <table class="table card-table table-striped table-vcenter text-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th class="wd-lg-8p"><span>{{__('auth.user')}}</span></th>
                                            <th class="wd-lg-20p"><span></span></th>
                                            <th class="wd-lg-20p"><span>{{__('auth.email')}}</span></th>
                                            <th class="wd-lg-20p"><span>{{__('admin/body.status')}}</span></th>
                                            <th class="wd-lg-20p"><span>{{__('admin/body.online')}}</span></th>
                                            <th class="wd-lg-20p"><span>{{__('admin/body.phone')}}</span></th>
                                            <th class="wd-lg-20p"><span>{{__('general.create-d')}}</span></th>
                                            <th class="wd-lg-20p">{{__('admin/body.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($admins as $admin)
                                        <tr>
                                            <td>
                                                <div>
                                                <img alt="avatar" class="avatar avatar-md brround"
                                                     src="{{$admin->image ? url::asset($admin->image->filename) : URL::asset('assets/admin/img/faces/1.jpg')}}">
                                                </div>
                                            </td>
                                            <td>{{$admin->name}}</td>
                                            <td>
                                                {{$admin->email}}
                                            </td>
                                            <td class="text-center">
                                                <span class="label text-muted d-flex">
                                                    @if($admin->is_active == 0)
                                                        <div class="dot-label bg-gray-300 mr-1"></div> {{__('general.inactive')}} </span>
                                                    @else
                                                        <div class="dot-label bg-success mr-1"></div> {{__('general.active')}} </span>
                                                    @endif
                                            </td>
                                            <td>
                                                @if($admin->isOnline())
                                                    <div class="dot-label bg-success mr-1"></div> {{__('admin/body.online')}} </span>
                                                @else
                                                    <div class="dot-label bg-gray-300 mr-1"></div> {{__('admin/body.offline')}} </span>
                                                @endif
                                            </td>
                                            <td>{{$admin->phone}}</td>
                                            <td>
                                                {{$admin->created_at->diffForHumans()}}
                                            </td>
                                            <td>
                                                <a href="{{route('admin.account.profileEdit', $admin->id)}}" class="btn btn-sm btn-info">
                                                    <i class="las la-pen"></i>
                                                </a>
                                                @if($admin->is_active == 0)
                                                    <a href="{{route('admin.account.recover', $admin->id)}}" class="btn btn-sm btn-success">
                                                        <i class="las la-check"></i>
                                                    </a>
                                                @else
                                                    <a href="#delete{{$admin->id}}" class="btn btn-sm btn-danger" data-toggle="modal">
                                                        <i class="las la-trash"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @include('admin.auth.delete')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><!-- COL END -->
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
