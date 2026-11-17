<!-- Modal -->
<div class="modal fade" id="delete{{ $value->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="exampleModalLabel">
                    {{ __('general.delete') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.category.delete') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-body">
                    <h5>{{ trans('messages.delete confirm') }}</h5>
                    <input type="hidden" name="id" value="{{$value->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('admin/body.cancel') }}</button>
                    <button type="submit"
                        class="btn btn-danger">{{ trans('general.confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
