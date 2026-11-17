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
    <form action="{{route('admin.material.update', $material)}}" method="post" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-12 col-xl-12 col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        <h4 class="card-title tx-white mb-1">{{__('general.basic')}}</h4>
                    </div>
                    <!-- Begin Form Basic Data  -->
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{$material->id}}">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label>{{__('admin/body.photo')}}</label>
                                <img alt="" style="height: 50px"
                                src="{{$material->image ? url::asset($material->image->filename) : URL::asset('assets/admin/img/faces/1.jpg')}}">
                            </div>
                            <div class="col-md-6">
                                <div class="custom-file form-group">
                                    <input class="custom-file-input" id="customFile" type="file" name="photo"> <label class="custom-file-label" for="customFile">{{__('admin/body.chose photo')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/sidebar.materialC')}}</label>
                                <select class="SlectBox form-control" name="material_category_id">
                                    <option disabled selected>{{__('admin/body.chose cat')}}</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if ($category->id == $material->material_category_id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @error('material_category_id')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/sidebar.unit')}}</label>
                                <select class="SlectBox form-control" name="unit_id">
                                    <option disabled selected>{{__('admin/sidebar.unit')}}</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}" @if ($unit->id == $material->unit_id) selected @endif>{{$unit->name}}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/sidebar.roast level')}}</label>
                                <select class="SlectBox form-control" name="roast_level_id">
                                    <option disabled selected>{{__('admin/sidebar.roast level')}}</option>
                                    @foreach($roasts as $roast)
                                        <option value="{{$roast->id}}" @if ($roast->id == $material->roast_level_id) selected @endif>{{$roast->name}}</option>
                                    @endforeach
                                </select>
                                @error('roast_level_id')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.code')}}</label>
                                <input type="text" class="form-control" id="inputName" disabled name="code" value="{{$material->code}}">
                                @error('code')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.barcode')}}</label>
                                <input type="text" class="form-control" id="inputName" name="barcode" value="{{$material->barcode}}">
                                @error('barcode')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.lifeDays')}}</label>
                                <input type="text" class="form-control" id="inputName" name="shelf_life_days" value="{{$material->shelf_life_days}}">
                                @error('shelf_life_days')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.minStock')}}</label>
                                <input type="text" class="form-control" id="inputName" name="min_stock_level" value="{{$material->min_stock_level}}">
                                @error('min_stock_level')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.reorder')}}</label>
                                <input type="text" class="form-control" id="inputName" name="reorder_level" value="{{$material->reorder_level}}">
                                @error('reorder_level')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="projectinput1">{{__('admin/body.maxStock')}}</label>
                                <input type="text" class="form-control" id="inputName" name="max_stock_level" value="{{$material->max_stock_level}}">
                                @error('max_stock_level')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.costPrice')}}</label>
                                <input type="text" class="form-control" id="inputName" name="cost_price" value="{{$material->cost_price}}">
                                @error('cost_price')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="projectinput1">{{__('admin/body.currency')}}</label>
                                <input type="text" class="form-control" id="inputName" name="currency" value="{{$material->currency}}">
                                @error('currency')
                                <span class="alert text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-3">
                                <div class="form-group mb-0 mt-3 justify-content-end">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="is_perishable" @if ($material->is_perishable == 1) checked @endif class="custom-control-input" id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">{{__('admin/body.perishable')}}</label>
                                    </div>
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
                                                    <input type="text" class="form-control" id="inputName" name="{{$key}}[name]" placeholder="" value="{{$material->translate($key)->name}}">
                                                    @error($key.'*.name')
                                                    <span class="alert text-danger">{{$message}}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="projectinput1">{{__('admin/body.description')}}</label>
                                                    <textarea class="form-control" id="inputName" name="{{$key}}[description]">{{$material->translate($key)->description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6">
                                                    <label for="projectinput1">{{__('admin/body.notes')}}</label>
                                                    <textarea class="form-control" id="inputName" name="{{$key}}[notes]" >{{$material->translate($key)->notes}}</textarea>
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

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
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
