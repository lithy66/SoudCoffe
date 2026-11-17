{{--<button class="btn btn-primary pull-right" wire:click="show_form_add" flavor="button">اضافة فاتورة جديدة </button><br><br>--}}
<div class="d-flex my-xl-auto right-content ">
    <div class="pr-1 mb-3 mb-xl-0">
        <button class="btn btn-primary btn-with-icon btn-block form-group" wire:click="show_form_add">{{__('general.add')}}<span class="material-symbols-outlined" style="margin-right: 5px">add_task</span></button>
    </div>
</div>
<div class="table-responsive">
    <table class="table text-md-nowrap" id="example1">
        <thead>
        <tr>
            <th class="wd-5-f border-bottom-0">#</th>
            <th>{{__('admin/sidebar.service')}}</th>
            <th>{{__('admin/sidebar.branch')}}</th>
            <th>{{__('admin/body.date').' '.__('admin/sidebar.bill')}}</th>
            <th>{{__('admin/sidebar.doctors')}}</th>
            <th>{{__('admin/sidebar.category')}}</th>
            <th>{{__('admin/body.price')}}</th>
            <th>{{__('admin/body.discount')}}</th>
            <th>{{__('admin/body.tax')}}</th>
            <th>{{__('admin/body.tax')}}</th>
            <th>{{__('admin/body.total')}}</th>
            <th>{{__('admin/body.status')}}</th>
            <th class="wd-15p-f border-bottom-0">{{__('admin/body.action')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($single_invoices as $single_invoice)
            <tr>
                <td>{{ $loop->iteration}}</td>
                <td>{{ $single_invoice->Service->name }}</td>
                <td>{{ $single_invoice->Patient->name }}</td>
                <td>{{ $single_invoice->invoice_date }}</td>
                <td>{{ $single_invoice->Doctor->name }}</td>
                <td>{{ $single_invoice->Specialty->name }}</td>
                <td>{{ number_format($single_invoice->price, 2) }}</td>
                <td>{{ number_format($single_invoice->discount_value, 2) }}</td>
                <td>{{ $single_invoice->tax_rate }}%</td>
                <td>{{ number_format($single_invoice->tax_value, 2) }}</td>
                <td>{{ number_format($single_invoice->total_with_tax, 2) }}</td>
                <td>{{ $single_invoice->type == 1 ? __('admin/body.cash'):__('admin/body.suspend') }}</td>
                <td>
                    <button wire:click="edit({{ $single_invoice->id }})" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$single_invoice->id}}"><i class="fa fa-trash"></i></button>
                    <button wire:click="print({{ $single_invoice->id }})" class="btn btn-success btn-sm" style="margin: 5px 0;"><i class="ti-printer"></i></button>
                </td>
            </tr>
            @include('livewire.BillSingleServices.delete')
        @endforeach
        </tbody>
    </table>

</div>
