<div class="d-flex my-xl-auto right-content">
    <div class="pr-1 mb-3 mb-xl-0">
        <button class="btn btn-primary btn-with-icon btn-block" wire:click="show_form_add" type="button">{{__('general.add')}}<span class="material-symbols-outlined" style="margin-right: 5px">add_task</span></button><br><br>
    </div>
</div>
{{--<button class="btn btn-primary btn-with-icon btn-block" wire:click="show_form_add" flavor="button">{{__('general.add')}}<span class="roastLevels-symbols-outlined" style="margin-right: 5px">add_task</span></button><br><br>--}}
<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1" data-page-length="50"style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>{{__('admin/body.name')}}</th>
            <th>{{__('admin/body.total&tax')}}</th>
            <th>{{__('admin/body.description')}}</th>
            <th>{{__('admin/body.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($groups as $group)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $group->name }}</td>
                <td>{{ number_format($group->Total_with_tax, 2) }}</td>
                <td>{{ $group->notes }}</td>
                <td>
                    <button wire:click="edit({{ $group->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteGroup{{$group->id}}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @include('livewire.GroupServices.delete')
        @endforeach
    </table>

</div>

{{--@extends('admin.layouts.master')--}}
{{--@section('css')--}}
{{--    <link href="{{URL::asset('assets/admin/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />--}}
{{--    <link href="{{URL::asset('assets/admin/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{URL::asset('assets/admin/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />--}}
{{--    <link href="{{URL::asset('assets/admin/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{URL::asset('assets/admin/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">--}}
{{--    <link href="{{URL::asset('assets/admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet">--}}
{{--@endsection--}}
{{--@section('page-header')--}}
{{--    @include('admin.include.messages_alert')--}}
{{--				<!-- breadcrumb -->--}}
{{--                <div class="breadcrumb-header justify-content-between">--}}
{{--                    <div class="my-auto">--}}
{{--                        <div class="d-flex">--}}
{{--                            <h4 class="content-title mb-0 my-auto">{{__('admin/sidebar.multi pack')}}</h4><a href="{{route('admin.dashboard')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/body.home')}}</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="d-flex my-xl-auto right-content">--}}
{{--                        <div class="pr-1 mb-3 mb-xl-0">--}}
{{--                            <button flavor="button" class="btn btn-primary btn-with-icon" data-toggle="modal" data-target=".bd-example-modal-lg">--}}
{{--                                {{__('general.add')}} <span class="roastLevels-symbols-outlined" style="margin-right: 5px">add_task</span>--}}
{{--                            </button>--}}
{{--                            <a href="{{route('admin.Add_GroupServices')}}" class="btn btn-primary btn-with-icon btn-block">{{__('general.add')}}<span class="roastLevels-symbols-outlined" style="margin-right: 5px">add_task</span></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--				<!-- breadcrumb -->--}}
{{--@endsection--}}
{{--@section('content')--}}

{{--				<!-- table -->--}}
{{--                <div class="row row-sm">--}}
{{--                    <div class="col-xl-12">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-header pb-0">--}}
{{--                                <div class="d-flex justify-content-between">--}}
{{--                                    <h4 class="card-title mg-b-0">{{__('general.all')}} {{__('admin/sidebar.multi pack')}}</h4>--}}
{{--                                    <i class="mdi mdi-dots-horizontal text-gray"></i>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="table-responsive">--}}
{{--                                    <table class="table text-md-nowrap" id="example1">--}}
{{--                                        <thead>--}}
{{--                                        <tr>--}}
{{--                                            <th class="wd-5p border-bottom-0"> # </th>--}}
{{--                                            <th class="wd-15p border-bottom-0">{{__('admin/body.name')}}</th>--}}
{{--                                            <th class="wd-15p border-bottom-0">{{__('admin/body.price')}}</th>--}}
{{--                                            <th class="wd-15p border-bottom-0">{{__('admin/body.description')}}</th>--}}
{{--                                            <th class="wd-10p border-bottom-0">{{__('admin/body.action')}}</th>--}}
{{--                                        </tr>--}}
{{--                                        </thead>--}}
{{--                                        <tbody>--}}
{{--                                        @foreach($groups as $value)--}}
{{--                                            <tr>--}}
{{--                                                <td>{{$value->id}}</td>--}}
{{--                                                <td>{{$value->name}}</td>--}}
{{--                                                <td>{{number_format($value->Total_with_tax, 2)}}</td>--}}
{{--                                                <td>{{$value->notes}}</td>--}}
{{--                                                <td>--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" flavor="button">{{__('admin/body.action')}}<i class="fas fa-caret-down mr-1"></i></button>--}}
{{--                                                        <div class="dropdown-menu tx-13">--}}
{{--                                                            <a class="dropdown-item" href="{{route('admin.service.one pack.edit',$value->id)}}"><i style="color: #0ba360" class="text-success ti-user"></i>&nbsp;&nbsp; {{__('auth.edit profile')}}</a>--}}
{{--                                                            <a class="dropdown-item" href="#update_status{{$value->id}}" data-toggle="modal" data-target=""><i class="text-warning ti-back-right"></i>&nbsp;&nbsp;{{__('general.edit').' '.__('admin/body.status') }} </a>--}}
{{--                                                            <a class="dropdown-item" href="#delete{{$value->id}}" data-toggle="modal"><i class="text-danger ti-trash"></i>&nbsp;&nbsp; {{__('general.delete')}}</a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </td>--}}
{{--                                            </tr>--}}
{{--                                            @include('admin.service.Single package.delete')--}}
{{--                                        @endforeach--}}
{{--                                        </tbody>--}}
{{--                                    </table>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--				<!-- row closed -->--}}
{{--			</div>--}}
{{--			<!-- Container closed -->--}}
{{--		</div>--}}
{{--		<!-- main-content closed -->--}}
{{--@endsection--}}
{{--@section('js')--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/jquery.dataTables.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/jszip.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/pdfmake.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/vfs_fonts.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/buttons.html5.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/buttons.print.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/buttons.colVis.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>--}}
{{--    <script src="{{URL::asset('assets/admin/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>--}}
{{--    <!--Internal  Datatable js -->--}}
{{--    <script src="{{URL::asset('assets/admin/js/table-data.js')}}"></script>--}}
{{--@endsection--}}
