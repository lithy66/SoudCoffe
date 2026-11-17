@extends('admin.layouts.master')
@section('css')
@endsection
@section('title')
    {{$setting->title .' '.__('admin/sidebar.bills').' '.__('admin/sidebar.one pack')}}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('admin/sidebar.bills').' '.__('admin/sidebar.multi pack')}}</h4><a href="{{route('admin.dashboard')}}" class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('admin/body.home')}}</a>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
                <div class="row row-sm">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <livewire:bill-single-services/>
                            </div>
                        </div>
                    </div>
                </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
@endsection
