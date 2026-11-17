@extends('admin.layouts.master')
@section('css')
    <link href="{{URL::asset('assets/admin/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{$header_title}}</h4><a href="{{route('admin.dashboard')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/body.home')}}</a>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    <form action="{{route('admin.roles.update', $role->id)}}" method="post" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="card-title tx-white mb-1">{{__('admin/roles.title')}}</h4>
                    </div>
                    <div class="card-body">
                        @include('admin.roles._form')
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/admin/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/notify/js/notifit-custom.js')}}"></script>
@endsection
