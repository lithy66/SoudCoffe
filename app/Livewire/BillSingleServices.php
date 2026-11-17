<?php

namespace App\Livewire;

use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Service;
use App\Models\SingleInvoice;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class BillSingleServices extends Component
{
    public $InvoiceSaved,$InvoiceUpdated;
    public $show_table = true;
    public $tax_rate = 17;
    public $updateMode = false;
    public $price,$discount_value = 0 ,$patient_id,$doctor_id,$specialty_id,$type,$Service_id,$single_invoice_id;

    public function render()
    {
        return view('livewire.BillSingleServices.bill-single-services', [
            'single_invoices'=> SingleInvoice::all(),
            'Patients'=> Patient::all(),
            'Doctors'=> Doctor::all(),
            'Services'=> Service::all(),
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value'=> $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]);
    }

    public function show_form_add()
    {
        $this->show_table = false;
    }

    public function print($id)
    {
        $single_invoices = SingleInvoice::findOrFail($id);
        return Redirect::route('admin.printInvoices',[
            'invoice_date' => $single_invoices->invoice_date,
            'patient_id' => $single_invoices->Patient->name,
            'doctor_id' => $single_invoices->Doctor->name,
            'specialty_id' => $single_invoices->Specialty->name,
            'service_id' => $single_invoices->Service->name,
            'flavor' => $single_invoices->type,
            'price' => $single_invoices->price,
            'discount_value' => $single_invoices->discount_value,
            'tax_rate' => $single_invoices->tax_rate,
            'total_with_tax' => $single_invoices->total_with_tax,
            'header_title' => __('general.print').' '.__('admin/sidebar.bills'),
        ]);
    }

    public function get_specialty()
    {
        $doctor_id = Doctor::with('specialty')->where('id', $this->doctor_id)->first();
        $this->specialty_id = $doctor_id->specialty->name;
    }

    public function get_price()
    {
        $this->price = Service::where('id', $this->Service_id)->first()->price;
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $single_invoice = SingleInvoice::findorfail($id);
        $this->single_invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_id = $single_invoice->doctor_id;
        $this->specialty_id = DB::table('specialty_translations')->where('id', $single_invoice->specialty_id)->first()->name;
        $this->Service_id = $single_invoice->Service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;
    }


    public function store()
    {
        if ($this->type == 1)
        {
            DB::beginTransaction();
            try
            {
//                Cash
                if ($this->updateMode)
                {
                    $single_invoices = SingleInvoice::findorfail($this->single_invoice_id);
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_id;
                    $single_invoices->specialty_id = DB::table('specialty_translations')->where('name', $this->specialty_id)->first()->specialty_id;
                    $single_invoices->Service_id = $this->Service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $fund_accounts = FundAccount::where('single_invoice_id',$this->single_invoice_id)->first();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->single_invoice_id = $single_invoices->id;
                    $fund_accounts->debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();
                    $this->InvoiceUpdated =true;
                    $this->show_table =true;
                }
                else
                {
                    $single_invoices = new SingleInvoice();
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_id;
                    $single_invoices->specialty_id = DB::table('specialty_translations')->where('name', $this->specialty_id)->first()->specialty_id;
                    $single_invoices->Service_id = $this->Service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $fund_accounts = new FundAccount();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->single_invoice_id = $single_invoices->id;
                    $fund_accounts->debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();
                    $this->InvoiceSaved =true;
                    $this->show_table =true;
                }
                DB::commit();
            }
            catch (\Exception $ex)
            {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
            }
        }
        else
        {
//                Suspend
            DB::beginTransaction();
            try {

                if ($this->updateMode)
                {
                    $single_invoices = SingleInvoice::findorfail($this->single_invoice_id);
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_id;
                    $single_invoices->specialty_id = DB::table('specialty_translations')->where('name', $this->specialty_id)->first()->specialty_id;
                    $single_invoices->Service_id = $this->Service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $patient_accounts = PatientAccount::where('single_invoice_id',$this->single_invoice_id)->first();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->single_invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();
                    $this->InvoiceUpdated =true;
                    $this->show_table =true;
                }
                else
                {

                    $single_invoices = new SingleInvoice();
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_id;
                    $single_invoices->specialty_id = DB::table('specialty_translations')->where('name', $this->specialty_id)->first()->specialty_id;
                    $single_invoices->Service_id = $this->Service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    // قيمة الضريبة = السعر - الخصم * نسبة الضريبة /100
                    $single_invoices->tax_value = ($this->price -$this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    // الاجمالي شامل الضريبة  = السعر - الخصم + قيمة الضريبة
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $patient_accounts = new PatientAccount();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->single_invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();
                    $this->InvoiceSaved =true;
                    $this->show_table =true;
                }
                DB::commit();
            }
            catch (\Exception $ex)
            {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
            }
        }
    }

    public function delete($id)
    {
        $this->single_invoice_id = $id;
    }

    public function destroy(){
        SingleInvoice::destroy($this->single_invoice_id);
        return redirect()->to('admin/bills/Add_BillSingleServices');
    }


}
