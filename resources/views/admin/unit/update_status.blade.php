<!-- Modal -->
<div class="modal fade" id="update_status{{ $value->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{__('general.edit')}} {{ __('admin/body.status') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.warehouse.status', 'warehouse')}}" method="post" autocomplete="off">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status">{{__('admin/body.status')}}</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="" selected disabled>--{{__('admin/body.chose')}}--</option>
                            <option value="1">{{__('general.active')}}</option>
                            <option value="0">{{trans('general.inactive')}}</option>
                        </select>
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
