<!-- Modal -->
<div class="modal fade" id="update_status{{ $value->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{__('admin/body.change_status')}} {{ $value->po_number }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.purchaseOrder.status')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status{{ $value->id }}">{{__('admin/body.status')}}</label>
                        <select class="form-control" id="status{{ $value->id }}" name="status" required>
                            <option value="" selected disabled>--{{__('admin/body.chose')}}--</option>
                            @if($value->status == 'draft')
                                <option value="sent">{{__('admin/body.approve')}}</option>
                            @endif
                            <option value="cancelled">{{__('admin/body.cancel_order')}}</option>
                        </select>
                        @if($value->status == 'draft')
                            <small class="text-muted">{{__('admin/body.approve_hint')}}</small>
                        @endif
                    </div>

                    <input type="hidden" name="id" value="{{ $value->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('general.close')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('general.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
