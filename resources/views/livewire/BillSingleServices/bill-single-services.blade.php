<div>
@if($InvoiceSaved)
        <div class="alert alert-success">{{__('messages.save')}}</div>
    @endif

@if($InvoiceUpdated)
        <div class="alert alert-success">{{__('messages.edit')}}</div>
    @endif

@if($show_table)
    @include('livewire.BillSingleServices.table')
    @else
    @include('livewire.BillSingleServices.form')
    @endif
</div>
