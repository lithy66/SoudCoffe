@extends('admin.layouts.master')
@section('css')
    <!--Internal Sumoselect css-->

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
    <form action="{{route('admin.purchaseOrder.store')}}" method="post" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="card-title tx-white mb-1">{{__('general.basic')}}</h4>
                    </div>
                    <!-- Begin Form Basic Data  -->
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.flavor')}}</label>
                                <select name="type" class="form-control SlectBox" id="type">
                                    <option value="" selected disabled>------</option>
                                    <option value="powder">{{__('admin/body.powder')}}</option>
                                    <option value="drink">{{__('admin/body.drink')}}</option>
                                </select>
                                @error('flavor')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput2">{{__('admin/body.chose cat')}} </label>
                                <div class="form-s2">
                                    <div>
                                        <select name="category_id"
                                                class="form-control formselect required"
                                                placeholder="{{__('admin/body.chose cat')}}" id="sub_category_name">
                                            <option value="0" disabled selected>
                                                {{__('admin/body.chose cat')}}</option>
                                            @if($categories && $categories -> count() > 0)
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}">
                                                        {{ ucfirst($category->name) }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput2">{{__('admin/body.chose SubCat')}} </label>
                                <select class="form-control formselect required"
                                        placeholder="{{__('admin/body.chose subcat')}}" id="sub_category" name="category_id">
                                </select>
                            </div>
                        </div>
                        <div class="row form-group variants">
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.Quantity')}}</label>
                                <input type="text" id="sku" class="form-control" placeholder="  " value="{{old('stock')}}" name="stock">
                                @error("stock")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.code')}}
                                </label>
                                <input type="text" id="sku" class="form-control" placeholder="  " value="{{old('sku')}}" name="sku">
                                @error("sku")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.price')}}</label>
                                <input type="text" id="sku" class="form-control" placeholder="  " value="{{old('price')}}" name="price">
                                @error("price")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.photo')}}</label>
                                <div class="custom-file form-group">
                                    <input class="custom-file-input" id="customFile" type="file" name="photo"> <label class="custom-file-label" for="customFile">{{__('admin/body.chose photo')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card" id="tabs-style2">
                    <div class="card-header bg-dark">
                        <h4 class="card-title tx-white mb-1">{{__('general.product')}}</h4>
                    </div>
                    <!-- Begin Form Basic Data  -->
                    <div class="card-body">
                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        @foreach(config('app.languages') as $key=>$lang)
                                            <li><a href="#{{$key}}" class="nav-link @if($loop->index == 0) active @endif" data-toggle="tab">{{$lang}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content">
                                    @foreach(config('app.languages') as $key=>$lang)
                                        <div class="tab-pane @if($loop->index == 0) active @endif" id="{{$key}}">
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <label for="projectinput1">{{__('admin/body.name')}}</label>
                                                    <input type="text" class="form-control" id="inputName" name="{{$key}}[name]" value="{{old($key.'*.name')}}" >
                                                    @error($key.'*.name')
                                                    <span class="alert text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-12">
                                                    <label for="projectinput1">{{__('admin/body.description')}}</label>
                                                    <textarea class="form-control" id="inputName" placeholder="{{__('admin/body.description')}}" name="{{$key}}[description]" value="{{old($key.'*.description')}}" ></textarea>
                                                    @error($key.'*.description')
                                                    <span class="alert text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row form-group variants" style="display: none">
                                                <div class="col-md-4">
                                                    <label for="projectinput1">{{__('admin/body.weight')}}</label>
                                                    <input type="text" class="form-control" id="inputName" name="{{$key}}[weight]" value="{{old($key.'*.weight')}}" >
                                                    @error($key.'*.weight')
                                                    <span class="alert text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="projectinput1">{{__('admin/body.grind_type')}}</label>
                                                    <input type="text" class="form-control" id="inputName" name="{{$key}}[grind_type]" value="{{old($key.'*.grind_type')}}" >
                                                    @error($key.'*.grind_type')
                                                    <span class="alert text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="projectinput1">{{__('admin/body.roast_level')}}</label>
                                                    <input type="text" class="form-control" id="inputName" name="{{$key}}[roast_level]" value="{{old($key.'*.roast_level')}}" >
                                                    @error($key.'*.roast_level')
                                                    <span class="alert text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <script type="prismsmix/javascript"></script>
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">{{__('general.save')}}</button>
                                <button type="submit" class="btn btn-secondary">{{__('general.cancel')}}</button>
                            </div>
                        </div>
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

    <script src="http://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        $(document).ready(function () {
            $('#sub_category_name').on('change', function () {
                let id = $(this).val();
                $('#sub_category').empty();
                $('#sub_category').append(`<option value="0" disabled selected>{{__('admin/body.Processing')}}</option>`);
                $.ajax({
                    type: 'GET',
                    url: 'subCategory/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        console.log(response);
                        $('#sub_category').empty();
                        $('#sub_category').append(`<option value="0" disabled selected>{{__('admin/body.chose SubCat')}}</option>`);
                        response.forEach(element => {
                            $('#sub_category').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('change', '#flavor', function () {
            if($(this).val() == 'drink')
            {
                $('.variants').hide();
            }else {
                $('.variants').show();
            }
        });
    </script>

    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/admin/js/select2.js') }}"></script>
    <script src="{{ URL::asset('assets/admin/js/advanced-form-elements.js') }}"></script>

    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/admin/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{URL::asset('assets/admin/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('assets/admin/plugins/notify/js/notifit-custom.js')}}"></script>

@endsection
