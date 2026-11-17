<div>

    @if ($InvoiceSaved)
        <div class="alert alert-info">{{__('messages.save')}}</div>
    @endif

    @if ($InvoiceUpdated)
        <div class="alert alert-info">{{__('messages.edit')}}</div>
    @endif

    @if($show_table)

        @include('livewire.single_invoices.Table')

    @else

        <form wire:submit.prevent="store" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col">
                    <label>{{__('admin/sidebar.patients')}}</label>
                    <select wire:model="patient_id" class="form-control" required>
                        <option value=""  >{{__('admin/body.chose')}}</option>
                        @foreach($Patients as $Patient)
                            <option value="{{$Patient->id}}">{{$Patient->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col">
                    <label>{{__('admin/sidebar.doctor')}}</label>
                    <select wire:model="doctor_id"  wire:change="get_specialty" class="form-control"  id="exampleFormControlSelect1" required>
                        <option value="" >{{__('admin/body.chose')}}</option>
                        @foreach($Doctors as $Doctor)
                            <option value="{{$Doctor->id}}">{{$Doctor->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col">
                    <label>{{__('admin/sidebar.specialty')}}</label>
                    <input wire:model="specialty_id" type="text" class="form-control" readonly >
                </div>

                <div class="col">
                    <label>{{__('admin/body.flavor')}}</label>
                    <select wire:model="type" class="form-control" {{$updateMode == true ? 'disabled':''}}>
                        <option value="" >{{__('admin/body.chose')}}</option>
                        <option value="1">{{__('admin/body.cash')}}</option>
                        <option value="2">{{__('admin/body.suspend')}}</option>
                    </select>
                </div>


            </div><br>

            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0"></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mg-b-0 text-md-nowrap" style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('admin/sidebar.service')}}</th>
                                        <th>{{__('admin/body.price')}}</th>
                                        <th>{{__('admin/body.discount')}}</th>
                                        <th>{{__('admin/body.tax').' '.__('admin/body.percent')}}</th>
                                        <th>{{__('admin/body.tax')}}</th>
                                        <th>{{__('admin/body.total')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>
                                            <select wire:model="Service_id" class="form-control" wire:change="get_price" id="exampleFormControlSelect1">
                                                <option value="">{{__('admin/body.chose')}}</option>
                                                @foreach($Services as $Service)
                                                    <option value="{{$Service->id}}">{{$Service->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td><input wire:model="price" type="text" class="form-control" readonly></td>
                                        <td><input wire:model="discount_value" type="text" class="form-control"></td>
                                        <th><input wire:model="tax_rate" type="text" class="form-control"></th>
                                        <td><input type="text" class="form-control" value="{{$tax_value}}" readonly ></td>
                                        <td><input type="text" class="form-control" readonly value="{{$subtotal + $tax_value }}"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- bd -->
                        </div><!-- bd -->
                    </div><!-- bd -->
                </div>
            </div>

            <input class="btn btn-outline-success" type="submit" value="{{__('general.confirm')}}">
        </form>

    @endif


</div>
