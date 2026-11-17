<div class="modal effect-flip-vertical show" id="show{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{$header_title}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <h6>{{$header_title}}</h6>


{{--                    <img alt="avatar" class="avatar-md mr-2"--}}
{{--                         src="{{$value->image ? url::asset($value->image->filename) : URL::asset('assets/admin/img/faces/1.jpg')}}">--}}
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.name')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.code')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->code}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/sidebar.materialC')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->materialCategory->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/sidebar.unit')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->unit->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/sidebar.roast level')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{($value->roast_level_id == null)? '--' : $value->roastLevel->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.barcode')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->barcode}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.minStock')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->min_stock_level}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.reorder')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->reorder_level}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.maxStock')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->max_stock_level}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.costPrice')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->cost_price}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.currency')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->currency}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.lifeDays')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->shelf_life_days}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.perishable')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{($value->is_perishable == 0)? __('general.inactive') : __('general.active')}}</span>
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
                            <span>{{__('admin/body.description')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->description}}</span>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
