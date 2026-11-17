<div class="row form-group">
    <div class="col-md-6">
        <label for="inputName">{{__('admin/body.name')}}</label>
        <input type="text" class="form-control" id="inputName" name="name"
               value="{{ old('name', $role->name ?? '') }}"
            {{ isset($role) ? 'readonly' : 'required' }}>
        @isset($role)
            <small class="text-muted">{{ __('admin/roles.name-hint') }}</small>
        @endisset
        @error('name')
        <span class="alert text-danger">{{$message}}</span>
        @enderror
        @error('error')
        <span class="alert text-danger">{{$message}}</span>
        @enderror
    </div>
</div>

@php $selected = old('permissions', $rolePermissions ?? []); @endphp

<h6 class="mt-4 mb-3">{{ __('admin/roles.permissions') }}</h6>

@foreach($groups as $group => $perms)
    <div class="card mb-3 border">
        <div class="card-header d-flex justify-content-between align-items-center">
            <strong>{{ __('admin/permissions.groups.' . $group) }}</strong>
            <label class="ckbox mb-0">
                <input type="checkbox" class="select-group" data-group="{{ $group }}">
                <span>{{ __('admin/roles.select-all') }}</span>
            </label>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($perms as $perm)
                    <div class="col-md-4 mb-2">
                        <label class="ckbox mb-0">
                            <input type="checkbox" name="permissions[]" value="{{ $perm }}"
                                   class="perm-{{ $group }}"
                                {{ in_array($perm, $selected) ? 'checked' : '' }}>
                            <span>{{ __('admin/permissions.labels.' . $perm) }}</span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endforeach
@error('permissions.*')
<span class="alert text-danger">{{$message}}</span>
@enderror

<div class="form-group mb-0 mt-3 justify-content-end">
    <div>
        <button type="submit" class="btn btn-primary">{{__('general.save')}}</button>
        <a href="{{route('admin.roles.index')}}" class="btn btn-secondary">{{__('general.cancel')}}</a>
    </div>
</div>

<script>
    document.querySelectorAll('.select-group').forEach(function (box) {
        box.addEventListener('change', function () {
            document.querySelectorAll('.perm-' + box.dataset.group).forEach(function (c) {
                c.checked = box.checked;
            });
        });
    });
</script>
