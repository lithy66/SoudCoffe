@extends('admin.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->
    <link href="{{URL::asset('assets/admin/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{Request::get('header_title')}}</h4><a href="{{route('admin.dashboard')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/body.home')}}</a>
            </div>
        </div>
{{--        <div class="d-flex my-xl-auto right-content">--}}
{{--            <div class="pr-1 mb-3 mb-xl-0">--}}
{{--                <a href="#" class="btn btn-primary btn-with-icon btn-block"><i class="text-white ti-printer"></i>&nbsp;&nbsp; {{__('general.print')}}</a>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <div class="invoice-header">
                            <h1 class="invoice-title">{{__('admin/sidebar.bills')}}</h1>
                            <div class="billed-from">
                                <img src="{{asset($setting->logo)}}" style="display: inline-block;margin: 0 4px 0;" class="main-logo" alt="{{$setting->title}}"><span style="color: black;text-transform: capitalize;font-weight: 500;">{{$setting->title}}</span>
                                <p>{{$setting->address}}<br>
                                    {{__('admin/body.tel')}}: {{$setting->phone}}<br>
                                    {{__('admin/body.mail')}}: {{$setting->email}}</p>
                            </div><!-- billed-from -->
                        </div><!-- invoice-header -->
                        <div class="row mg-t-20">
                            <div class="col-md">
                                <label class="tx-gray-600">{{__('general.info').' '.__('admin/sidebar.bills')}}</label>
                                <p class="invoice-header"><span>{{Request::get('invoice_date')}}</span> <span>{{__('admin/body.date')}}</span></p>
                                <p class="invoice-header"><span>{{Request::get('patient_id')}}</span><span>{{__('admin/sidebar.branch')}}</span></p>
                                <p class="invoice-header"><span>{{Request::get('doctor_id')}}</span><span>{{__('admin/sidebar.doctor')}}</span></p>
                                <p class="invoice-header"><span>{{Request::get('specialty_id')}}</span><span>{{__('admin/sidebar.specialty')}}</span></p>
                            </div>
                        </div>
                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice border text-md-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="wd-20p">#</th>
                                    <th class="wd-40p">{{__('admin/sidebar.service')}}</th>
                                    <th class="tx-center">{{__('admin/body.price')}}</th>
                                    <th class="tx-right">{{__('admin/body.status')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="tx-12">{{ Request::get('service_id') }}</td>
                                    <td class="tx-center">{{ Request::get('price') }}</td>
                                    <td class="tx-right">{{Request::get('flavor') == 1 ?  __('admin/body.cash'):__('admin/body.suspend')}}</td>
                                </tr>
                                <tr>
                                    <td class="valign-middle" colspan="2" rowspan="4">
                                        <div class="invoice-notes">
                                            <label class="main-content-label tx-13"></label>
                                        </div><!-- invoice-notes -->
                                    </td>
                                    <td class="tx-right">{{__('admin/body.total')}}</td>
                                    <td class="tx-right" colspan="2"> {{number_format(Request::get('price'), 2)}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">{{__('admin/body.discount')}}</td>
                                    <td class="tx-right" colspan="2">{{Request::get('discount_value')}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right">{{__('admin/body.tax')}}</td>
                                    <td class="tx-right" colspan="2">% {{Request::get('tax_rate')}}</td>
                                </tr>
                                <tr>
                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">{{__('admin/body.total')}}</td>
                                    <td class="tx-right" colspan="2">
                                        <h4 class="tx-primary tx-bold">{{number_format(Request::get('total_with_tax'), 2)}}</h4>

                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <br><br><br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="invoice-info-row"><span>{{__('admin/sidebar.branch')}}</span> <span style="text-transform: capitalize">{{Auth::user()->type}}</span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="invoice-info-row "><span>{{Request::get('patient_id')}}</span> <span>{{Auth::user()->name}}</span></p>
                            </div>
                        </div>
                        <hr class="mg-b-40">
                        <a href="#" class="btn btn-info float-left mt-3 mr-2" id="print_Button" onclick="printDiv()">
                            <i class="mdi mdi-printer ml-1"></i>{{__('general.print')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <!--Internal  Chart.bundle js -->
    <script src="{{URL::asset('assets/admin/plugins/chart.js/Chart.bundle.min.js')}}"></script>


    <script type="text/javascript">
        function printDiv() {
            var printContents = document.getElementById('print').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
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
