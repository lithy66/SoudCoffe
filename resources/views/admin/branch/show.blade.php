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
                            <h4 class="content-title mb-0 my-auto">{{$header_title}}</h4><a href="{{route('admin.branch')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/sidebar.branch')}}</a><a href="{{route('admin.dashboard')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/body.home')}}</a>
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
                                    <h4 class="card-title mg-b-0">{{$header_title}}</h4>
{{--                                    <i class="mdi mdi-dots-horizontal text-gray"></i>--}}
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="panel panel-primary tabs-style-2">
                                    <div class=" tab-menu-heading">
                                        <div class="tabs-menu1">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs main-nav-line">
                                                 <li><a href="#tab1" class="nav-link active" data-toggle="tab">{{$header_title}}</a></li>
                                                 <li><a href="#tab2" class="nav-link " data-toggle="tab">{{__('admin/sidebar.bills')}}</a></li>
                                                 <li><a href="#tab3" class="nav-link " data-toggle="tab">{{__('admin/sidebar.receipt')}}</a></li>
                                                 <li><a href="#tab4" class="nav-link " data-toggle="tab">{{__('admin/body.statement')}}</a></li>
                                                 <li><a href="#tab5" class="nav-link " data-toggle="tab">{{__('admin/sidebar.lab')}}</a></li>
                                                 <li><a href="#tab6" class="nav-link " data-toggle="tab">{{__('admin/sidebar.ray')}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body main-content-body-right border">
                                        <div class="tab-content">
                                            <div class="tab-pane active " id="tab1">
                                                <div class="table-responsive">
                                                    <table class="table table-hover text-md-nowrap text-center">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('admin/body.name')}}</th>
                                                            <th>{{__('admin/body.gender')}}</th>
                                                            <th>{{__('admin/body.tel')}}</th>
                                                            <th>{{__('admin/body.blood')}}</th>
                                                            <th>{{__('admin/body.birthday')}}</th>
                                                            <th>{{__('auth.email')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>{{$patient->id}}</td>
                                                            <td>{{$patient->name}}</td>
                                                            <td>{{($patient->gender == 0)? __('admin/body.male') : __('admin/body.female')}}</td>
                                                            <td>{{$patient->phone}}</td>
                                                            <td>{{$patient->blood_group}}</td>
                                                            <td>{{$patient->date_birthday}}</td>
                                                            <td>{{$patient->email}}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <div class="table-responsive">
                                                    <table class="table table-hover text-md-nowrap text-center">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('admin/sidebar.service')}}</th>
                                                            <th>{{__('admin/body.date').' '.__('admin/sidebar.bill')}}</th>
                                                            <th>{{__('admin/body.status')}}</th>
                                                            <th>{{__('admin/body.total')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($invoices as $value)
                                                        <tr>
                                                            <td>{{$value->id}}</td>
                                                            <td>{{$value->Service->name}}</td>
                                                            <td>{{$value->invoice_date}}</td>
                                                            <td>{{$value->type == 1 ? __('admin/body.cash'):__('admin/body.suspend')}}</td>
                                                            <td>{{$value->total_with_tax}}</td>
                                                        </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th colspan="4" scope="row" class="alert alert-success">{{__('admin/body.total')}}</th>
                                                            <td class="alert alert-primary">{{number_format($invoices->sum('total_with_tax'), 2)}}</td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab3">
                                                <div class="table-responsive">
                                                    <table class="table table-hover text-md-nowrap text-center">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('admin/body.date')}}</th>
                                                            <th>{{__('admin/body.description')}}</th>
                                                            <th>{{__('admin/body.amount')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($receipts as $receipt)
                                                        <tr>
                                                            <td>{{$receipt->id}}</td>
                                                            <td>{{$receipt->date}}</td>
                                                            <td>{{$receipt->description}}</td>
                                                            <td>{{$receipt->debit}}</td>
                                                        </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th colspan="3" scope="row" class="alert alert-success">{{__('admin/body.total')}}</th>
                                                            <td class="alert alert-primary">{{number_format($receipts->sum('debit'), 2)}}</td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <div class="table-responsive">
                                                    <table class="table table-hover text-md-nowrap text-center">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>{{__('admin/body.date')}}</th>
                                                            <th>{{__('admin/body.description')}}</th>
                                                            <th>{{__('admin/body.debit')}}</th>
                                                            <th>{{__('admin/body.credit')}}</th>
                                                            <th>{{__('admin/body.total')}}</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($accounts as $account)
                                                        <tr>
                                                            <td>{{$account -> id}}</td>
                                                            <td>{{$account -> date}}</td>
                                                            <td>
                                                                @if($account->single_invoice_id == true)
                                                                    {{$account->SingleInvoice->Service->name}}
                                                                @elseif($account->receipt_id == true)
                                                                    {{$account->ReceiptAccount->description}}
                                                                @elseif($account->payment_id == true)
                                                                    {{$account->PaymentAccount->description}}
                                                                    @endif
                                                            </td>
                                                            <td>{{$account->debit}}</td>
                                                            <td>{{$account->credit}}</td>
                                                            <td></td>
                                                        </tr>
                                                            @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th colspan="3" scope="row" class="alert alert-success">{{__('admin/body.total')}}</th>
                                                            <td class="alert alert-primary">{{number_format($debit = $accounts->sum('debit'), 2)}}</td>
                                                            <td class="alert alert-primary">{{number_format($credit = $accounts->sum('credit'), 2)}}</td>
                                                            <td class="alert alert-danger">
                                                                {{$debit - $credit}}
                                                                @if($debit-$credit > 0)
                                                                    {{__('admin/body.debit')}}
                                                                @elseif($debit-$credit < 0)
                                                                    {{__('admin/body.credit')}}
                                                                @else($debit-$credit = 0)

                                                                @endif
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab5">
                                                <p>praesentium voluptatum deleniti atque corrquas molestias excepturi sint
                                                    occaecati cupiditate non provident,</p>
                                                <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                    id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                    expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                    optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                    possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                            </div>
                                            <div class="tab-pane" id="tab6">
                                                <p>praesentium voluptatum deleniti atque corrquas molestias excepturi sint
                                                    occaecati cupiditate non provident,</p>
                                                <p class="mb-0">similique sunt in culpa qui officia deserunt mollitia animi,
                                                    id est laborum et dolorum fuga. Et harum quidem rerum facilis est et
                                                    expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi
                                                    optio cumque nihil impedit quo minus id quod maxime placeat facere
                                                    possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script type="prismsmix/javascript"></script>
{{--                                <div class="form-group mb-0 mt-3 justify-content-end">--}}
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
