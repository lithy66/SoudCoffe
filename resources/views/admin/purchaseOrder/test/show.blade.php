<div class="modal effect-flip-vertical show" id="show{{ $value->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{$header_title}}</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <h6>{{$header_title}}</h6>

                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.po_number')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->po_number}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/sidebar.warehouse')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->warehouse->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/sidebar.suppliers')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->supplier->name}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.discount')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->discount_amount}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.status')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{($value->status}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.total')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->subtotal}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.tax')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->tax_amount}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.order_date')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->order_date}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.expected_date')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->expected_date}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.received_date')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->received_date}}</span>
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
                            <span>{{__('admin/body.notes')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{$value->notes}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.created by')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{($value->created_by}}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <span>{{__('admin/body.approved by')}}</span>:
                        </div>
                        <div class="col-md-4">
                            <span>{{($value->approved_by}}</span>
                        </div>
                    </div>
                </div>
            <div class="modal-footer">
                <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
            </div>
        </div>
    </div>
</div>
