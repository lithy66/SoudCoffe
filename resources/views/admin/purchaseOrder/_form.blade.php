{{-- الحقول المشتركة بين add و edit. $purchaseOrder موجود في التعديل بس --}}
@php $po = $purchaseOrder ?? null; @endphp

<div class="row">
    <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-header bg-dark">
                <h4 class="card-title tx-white mb-1">
                    {{__('admin/sidebar.purchase order')}}
                    @if($po) - {{$po->po_number}} @endif
                </h4>
            </div>
            <div class="card-body">

                {{-- بيانات الأمر --}}
                <div class="row form-group">
                    <div class="col-md-4">
                        <label>{{__('admin/sidebar.suppliers')}}</label>
                        <select name="supplier_id" class="form-control">
                            <option value="" disabled @selected(!old('supplier_id', $po?->supplier_id))>--{{__('admin/body.chose')}}--</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{$supplier->id}}" @selected(old('supplier_id', $po?->supplier_id) == $supplier->id)>{{$supplier->company_name}}</option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                        <span class="alert text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label>{{__('admin/sidebar.warehouse')}}</label>
                        <select name="warehouse_id" class="form-control" required>
                            <option value="" disabled @selected(!old('warehouse_id', $po?->warehouse_id))>--{{__('admin/body.chose')}}--</option>
                            @foreach($warehouses as $warehouse)
                                <option value="{{$warehouse->id}}" @selected(old('warehouse_id', $po?->warehouse_id) == $warehouse->id)>{{$warehouse->name}}</option>
                            @endforeach
                        </select>
                        @error('warehouse_id') <span class="alert text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label>{{__('admin/body.currency')}}</label>
                        <input type="text" name="currency" maxlength="5" class="form-control"
                               value="{{old('currency', $po?->currency ?? 'EGP')}}">
                        @error('currency') <span class="alert text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-4">
                        <label>{{__('admin/body.order_date')}}</label>
                        <input type="date" name="order_date" class="form-control" required
                               value="{{old('order_date', $po?->order_date?->format('Y-m-d') ?? now()->format('Y-m-d'))}}">
                        @error('order_date') <span class="alert text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label>{{__('admin/body.expected_date')}}</label>
                        <input type="date" name="expected_date" class="form-control"
                               value="{{old('expected_date', $po?->expected_date?->format('Y-m-d'))}}">
                        @error('expected_date') <span class="alert text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                {{-- البنود --}}
                <h5 class="mt-4">{{__('admin/body.items')}}</h5>

                @if($errors->has('items') || collect($errors->keys())->contains(fn ($k) => str_starts_with($k, 'items.')))
                    <div class="alert alert-danger">
                        @foreach(collect($errors->getMessages())->filter(fn ($m, $k) => str_starts_with($k, 'items'))->flatten() as $message)
                            <div>{{$message}}</div>
                        @endforeach
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="items-table">
                        <thead>
                        <tr>
                            <th style="min-width:220px">{{__('admin/sidebar.materials')}}</th>
                            <th style="width:110px">{{__('admin/sidebar.unit')}}</th>
                            <th style="width:140px">{{__('admin/body.Quantity')}}</th>
                            <th style="width:150px">{{__('admin/body.cost_unit')}}</th>
                            <th style="width:140px">{{__('admin/body.costPrice')}}</th>
                            <th style="width:60px"></th>
                        </tr>
                        </thead>
                        <tbody id="items-body"></tbody>
                    </table>
                </div>
                <button type="button" class="btn btn-outline-primary btn-sm" id="add-item">
                    + {{__('general.add').' '.__('admin/body.item')}}
                </button>

                {{-- قالب الصف: الـ JS بينسخه لكل بند --}}
                <template id="row-template">
                    <tr>
                        <td>
                            <select name="items[__IDX__][material_id]" class="form-control item-material" required>
                                <option value="" disabled selected>--{{__('admin/body.chose')}}--</option>
                                @foreach($materials as $material)
                                    <option value="{{$material->id}}"
                                            data-cost="{{$material->cost_price}}"
                                            data-unit="{{$material->unit?->name}}">{{$material->code ? $material->code.' - ' : ''}}{{$material->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="item-unit align-middle"></td>
                        <td><input type="number" step="0.001" min="0.001" name="items[__IDX__][ordered_quantity]" class="form-control item-qty" required></td>
                        <td><input type="number" step="0.0001" min="0" name="items[__IDX__][unit_cost]" class="form-control item-cost" required></td>
                        <td class="item-total align-middle">0.00</td>
                        <td class="text-center align-middle">
                            <button type="button" class="btn btn-sm btn-danger remove-item" title="{{__('general.delete')}}">&times;</button>
                        </td>
                    </tr>
                </template>

                {{-- الإجماليات --}}
                <div class="row mt-4">
                    <div class="col-md-6">
                        <label>{{__('admin/body.notes')}}</label>
                        <textarea name="notes" rows="4" class="form-control">{{old('notes', $po?->notes)}}</textarea>
                        @error('notes') <span class="alert text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr>
                                <th>{{__('admin/body.total')}}</th>
                                <td id="subtotal-view">0.00</td>
                            </tr>
                            <tr>
                                <th class="align-middle">{{__('admin/body.discount_percent')}}</th>
                                <td><input type="number" step="0.01" min="0" max="100" name="discount_percent" id="discount_percent" class="form-control"
                                           value="{{old('discount_percent', $po?->discount_percent ?? 0)}}"></td>
                            </tr>
                            <tr>
                                <th>{{__('admin/body.discount')}}</th>
                                <td id="discount-view">0.00</td>
                            </tr>
                            <tr>
                                <th class="align-middle">{{__('admin/body.tax_percent')}}</th>
                                <td><input type="number" step="0.01" min="0" max="100" name="tax_percent" id="tax_percent" class="form-control"
                                           value="{{old('tax_percent', $po?->tax_percent ?? 0)}}"></td>
                            </tr>
                            <tr>
                                <th>{{__('admin/body.tax')}}</th>
                                <td id="tax-view">0.00</td>
                            </tr>
                            <tr>
                                <th>{{__('admin/body.total&tax')}}</th>
                                <td><strong id="total-view">0.00</strong></td>
                            </tr>
                        </table>
                        @error('tax_percent') <span class="alert text-danger">{{$message}}</span> @enderror
                        @error('discount_percent') <span class="alert text-danger">{{$message}}</span> @enderror
                    </div>
                </div>

                <div class="form-group mb-0 mt-3 justify-content-end">
                    <button type="submit" class="btn btn-primary">{{__('general.save')}}</button>
                    <a href="{{route('admin.purchaseOrder')}}" class="btn btn-secondary">{{__('general.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
