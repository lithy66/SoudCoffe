<!-- Modal -->
<div class="modal fade" id="update_status{{ $value->id }}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{ trans('admin/body.status') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.materialC.status') }}" method="post" autocomplete="off">
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group">
                        <label for="status">{{__('admin/body.status')}}</label>
                        <select class="form-control" id="status" name="is_active" required>
                            <option value="" selected disabled>{{trans('admin/body.chose')}}</option>
                            <option value="1">{{__('general.active')}}</option>
                            <option value="0">{{__('general.inactive')}}</option>
                        </select>
                    </div>

                    <input type="hidden" name="id" value="{{ $value->id }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('admin/body.cancel')}}</button>
                    <button type="submit" class="btn btn-primary">{{trans('general.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
