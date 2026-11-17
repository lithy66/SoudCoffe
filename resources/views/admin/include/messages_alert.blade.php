@if(count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">.</span>
        </button>
        <strong>{{__('general.error')}}</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('true'))
    <script>
        window.onload = function () {
            notif({
                msg: "{{__('messages.true')}}",
                type: "success"
            });
        }
    </script>
@endif

@if(session()->has('false'))
    <script>
        window.onload = function () {
            notif({
                msg: "{{__('messages.false')}}",
                type: "error",
            });
        }
    </script>
@endif

@if(session()->has('login'))
    <script>
        window.onload = function () {
            notif({
                msg: "{{__('messages.logged in')}}",
                type: "success"
            });
        }
    </script>
@endif

@if(session()->has('logout'))
    <script>
        window.onload = function () {
            notif({
                msg: "{{__('messages.logout')}}",
                type: "success"
            });
        }
    </script>
@endif

@if(session()->has('permission'))
    <script>
        window.onload = function () {
            notif({
                msg: "{{__('messages.permission')}}",
                type: "success"
            });
        }
    </script>
@endif

@if(session()->has('no permission'))
    <script>
        window.onload = function () {
            notif({
                msg: "{{__('messages.no permission')}}",
                type: "success"
            });
        }
    </script>
@endif

@if(session()->has('no approve'))
    <script>
        window.onload = function () {
            notif({
                msg: "{{__('messages.no approve')}}",
                type: "success"
            });
        }
    </script>
@endif

