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
                            <a href="{{route('admin.material.add')}}" class="btn btn-primary btn-with-icon btn-block">{{__('general.add')}}<span class="material-symbols-outlined" style="margin-right: 5px">add_task</span></a>
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
                                        <img width="30" height="30" class="custom-icon" src={{URL::asset('assets/admin/img/flags/raw-materials.png')}} />
                                        <h4 class="card-title mg-b-0">{{__('general.all')}} {{$header_title}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-md-nowrap" id="example1">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0"></th>
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.name')}}</th>
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.code')}}</th>
{{--                                            <th class="wd-15p border-bottom-0">{{__('admin/sidebar.materialC')}}</th>--}}
{{--                                            <th class="wd-15p border-bottom-0">{{__('admin/sidebar.unit')}}</th>--}}
                                            <th class="wd-15p border-bottom-0">{{__('admin/sidebar.roast level')}}</th>
{{--                                            <th class="wd-15p border-bottom-0">{{__('admin/body.barcode')}}</th>--}}
{{--                                            <th class="wd-15p border-bottom-0">{{__('admin/body.minStock')}}</th>--}}
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.reorder')}}</th>
{{--                                            <th class="wd-40p border-bottom-0">{{__('admin/body.maxStock')}}</th>--}}
                                            <th class="wd-15p border-bottom-0">{{__('admin/body.costPrice')}}</th>
{{--                                            <th class="wd-40p border-bottom-0">{{__('admin/body.currency')}}</th>--}}
                                            <th class="wd-40p border-bottom-0">{{__('admin/body.lifeDays')}}</th>
                                            <th class="wd-40p border-bottom-0">{{__('admin/body.perishable')}}</th>
{{--                                            <th class="wd-10p border-bottom-0">{{__('admin/body.status')}}</th>--}}
                                            <th class="wd-10p border-bottom-0">{{__('general.create-d')}}</th>
                                            <th class="wd-10p border-bottom-0">{{__('admin/body.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($materials as $value)

                                            <tr class="@if($value->is_active == 0) bg-danger-transparent @endif">
                                                <td>
                                                    <img alt="avatar" class="avatar-md mr-2"
                                                         src="{{$value->image ? url::asset($value->image->filename) : URL::asset('assets/admin/img/faces/1.jpg')}}">
                                                </td>
                                                <td><a data-toggle="modal" data-effect="effect-flip-vertical" href="#show{{$value->id}}">{{$value->name}}</a></td>
                                                <td>{{$value->code}}</td>
{{--                                                <td>{{$value->materialCategory->name}}</td>--}}
{{--                                                <td>{{$value->unit->name}}</td>--}}
                                                <td>{{($value->roast_level_id == null)? '--' : $value->roastLevel->name}}</td>
{{--                                                <td>{{$value->barcode}}</td>--}}
{{--                                                <td>{{$value->min_stock_level}}</td>--}}
                                                <td>{{$value->reorder_level}}</td>
{{--                                                <td>{{$value->max_stock_level}}</td>--}}
                                                <td>{{$value->cost_price}}</td>
{{--                                                <td>{{$value->currency}}</td>--}}
                                                <td>{{$value->shelf_life_days}}</td>
                                                <td>{{($value->is_perishable == 0)? __('general.inactive') : __('general.active')}}</td>
{{--                                                <td>{{($value->is_active == 0)? __('general.inactive') :  __('general.active')}}</td>--}}
                                                <td>{{$value->created_at->diffForHumans()}}</td>
{{--                                                <td>{{\Str::limit($value->notes, 90)}}</td>--}}
                                                <td>
                                                    <div class="dropdown">
                                                        <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-outline-primary btn-sm" data-toggle="dropdown" type="button">{{__('admin/body.action')}}<i class="fas fa-caret-down notif-text-start"></i></button>
                                                        <div class="dropdown-menu tx-13">
                                                            <a class="dropdown-item" href="{{route('admin.material.edit',$value->id)}}"><i style="color: #0ba360" class="text-success ti-reload"></i>&nbsp;&nbsp; {{__('general.edit')}}</a>
                                                            <a class="dropdown-item" href="#update_status{{$value->id}}" data-toggle="modal" data-target=""><i class="text-warning ti-back-right"></i>&nbsp;&nbsp;{{__('general.edit').' '.__('admin/body.status') }} </a>
                                                            <a class="dropdown-item" href="#delete{{$value->id}}" data-toggle="modal"><i class="text-danger ti-trash"></i>&nbsp;&nbsp; {{__('general.delete')}}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @include('admin.material.delete')
                                            @include('admin.material.show')
                                            @include('admin.material.update_status')
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="modal" id="scrollmodal" aria-hidden="true" style="display: none;">--}}
{{--                    <div class="modal-dialog modal-dialog-scrollable" role="document">--}}
{{--                        <div class="modal-content modal-content-demo">--}}
{{--                            <div class="modal-header">--}}
{{--                                <h6 class="modal-title">Scrolling With Content Modal</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>--}}
{{--                            </div>--}}
{{--                            <div class="modal-body">--}}
{{--                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>--}}
{{--                                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. </p>--}}
{{--                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>--}}
{{--                                <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.</p>--}}
{{--                                <p>These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.</p>--}}
{{--                            </div>--}}
{{--                            <div class="modal-footer">--}}
{{--                                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
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
