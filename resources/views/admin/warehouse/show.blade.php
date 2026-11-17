<div class="modal effect-flip-vertical show" id="show{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{$header_title}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
{{--                <h6>{{$header_title}}</h6>--}}

                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.name')}}</span>:
                        </div>
                        <div class="col-md-6">
                            <span>{{$value->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.address')}}</span>:
                        </div>
                        <div class="col-md-6">
                            <span>{{$value->address}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.manager')}}</span>:
                        </div>
                        <div class="col-md-6">
                            <span>{{$value->admin->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/sidebar.branches')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{($value->branch_id == null)? '--' : $value->branch->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('general.type')}}</span>:
                        </div>
                        <div class="col-md-6">
                            <span>@if($value->type == 'main')
                                    {{__('admin/body.main')}}
                                @elseif($value->type == 'branch')
                                    {{__('admin/sidebar.branches')}}
                                @else
                                    {{__('admin/body.online')}}
                                @endif</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.phone')}}</span>:
                        </div>
                        <div class="col-md-6">
                            <span>{{$value->phone}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.notes')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->notes}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.status')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{($value->is_active == 0)? __('general.inactive') :  __('general.active')}}</span>
                        </div>
                    </div>

                </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
