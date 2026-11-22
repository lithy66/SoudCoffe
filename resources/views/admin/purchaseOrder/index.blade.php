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
        @can('create-purchase-order')
            <div class="d-flex my-xl-auto right-content">
                <div class="pr-1 mb-3 mb-xl-0">
                    <a href="{{route('admin.purchaseOrder.add')}}" class="btn btn-primary btn-with-icon btn-block">{{__('general.add')}}<span class="material-symbols-outlined" style="margin-right: 5px">add_task</span></a>
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
                            <i class="fa-solid fa-file-invoice custom-icon"></i>
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
                                <th class="wd-5p border-bottom-0"> # </th>
                                <th class="wd-10p border-bottom-0">{{__('admin/body.po_number')}}</th>
                                <th class="wd-15p border-bottom-0">{{__('admin/sidebar.suppliers')}}</th>
                                <th class="wd-15p border-bottom-0">{{__('admin/sidebar.warehouse')}}</th>
                                <th class="wd-10p border-bottom-0">{{__('admin/body.order_date')}}</th>
                                <th class="wd-10p border-bottom-0">{{__('admin/body.total')}}</th>
                                <th class="wd-10p border-bottom-0">{{__('admin/body.status')}}</th>
                                <th class="wd-10p border-bottom-0">{{__('admin/body.created by')}}</th>
                                <th class="wd-10p border-bottom-0">{{__('admin/body.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($purchaseOrders as $value)
                                @php
                                    $badge = [
                                        'draft' => 'badge-secondary', 'sent' => 'badge-primary',
                                        'partially_received' => 'badge-warning', 'received' => 'badge-success',
                                        'cancelled' => 'badge-danger',
                                    ][$value->status] ?? 'badge-secondary';
                                    $canChangeStatus = in_array($value->status, ['draft', 'sent']);
                                    $canDelete       = in_array($value->status, ['draft', 'cancelled']);
                                @endphp
                                <tr class="@if($value->status == 'cancelled') bg-pink-transparent @endif">
                                    <td>{{$value->id}}</td>
                                    <td>{{$value->po_number}}</td>
                                    <td>{{$value->supplier?->name}}</td>
                                    <td>{{$value->warehouse?->name}}</td>
                                    <td>{{$value->order_date?->format('Y-m-d')}}</td>
                                    <td>{{number_format($value->total_amount, 2)}} {{$value->currency}}</td>
                                    <td><span class="badge {{$badge}}">{{__('admin/purchase_order.statuses.'.$value->status)}}</span></td>
                                    <td>{{$value->creator?->name}}</td>
                                    <td>
                                        @if($value->isEditable() || ($canChangeStatus || $canDelete))
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{__('admin/body.action')}}<i class="fas fa-caret-down mr-1"></i></button>
                                                <div class="dropdown-menu tx-13">
                                                    @if($value->isEditable())
                                                        @can('create-purchase-order')
                                                            <a class="dropdown-item" href="{{route('admin.purchaseOrder.edit',$value->id)}}"><i style="color: #0ba360" class="text-success ti-reload"></i>&nbsp;&nbsp; {{__('general.edit')}}</a>
                                                        @endcan
                                                    @endif
                                                    @can('approve-purchase-order')
                                                        @if($canChangeStatus)
                                                            <a class="dropdown-item" href="#update_status{{$value->id}}" data-toggle="modal"><i class="text-warning ti-back-right"></i>&nbsp;&nbsp;{{__('admin/purchase_order.change_status')}}</a>
                                                        @endif
                                                        @if($canDelete)
                                                            <a class="dropdown-item" href="#delete{{$value->id}}" data-toggle="modal"><i class="text-danger ti-trash"></i>&nbsp;&nbsp; {{__('general.delete')}}</a>
                                                        @endif
                                                    @endcan
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @can('approve-purchase-order')
                                    @include('admin.purchaseOrder.delete')
                                    @include('admin.purchaseOrder.update_status')
                                @endcan
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
