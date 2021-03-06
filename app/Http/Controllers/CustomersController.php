<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\GlcoaEditFormRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use TCPDF;
use Toastr;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::sortable()->paginate(env('CUSTOMER_PAGINATION_MAX'));
        return view('customers.index')->with('customers', $customers);
    }

    public function get()
    {
        $customers = Customer::sortable()->paginate(env('CUSTOMER_PAGINATION_MAX'));
        return $customers;
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $customer = new customer(array(
            'customer' => $request->get('customer'),
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'zip' => $request->get('zip'),
        ));
        $customer->save();
        Toastr::success('Customer created.');
        return redirect('/customers');
    }

    public function show($id)
    {
        $customer = Customer::whereId($id)->firstOrFail();
        return view('customers.show')->with('customer', $customer);
    }

    public function edit($id)
    {
        $customer = Customer::whereId($id)->firstOrFail();
        return view('customers.edit')->with('customer', $customer);
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::whereId($id)->firstOrFail();
        $customer->customer = $request->get('customer');
        $customer->street = $request->get('street');
        $customer->city = $request->get('city');
        $customer->state = $request->get('state');
        $customer->zip = $request->get('zip');
        $customer->save();
        Toastr::success('Customer updated.');
        return redirect(action('CustomersController@index', $customer->$customer));
    }

    public function destroy($id)
    {
        Customer::find($id)->delete();
        $customers = Customer::orderBy('customer')->paginate(env('CUSTOMER_PAGINATION_MAX'));
        return view('customers.index')->with('customers', $customers);
    }

    public function excel()
    {
        $table = with(new Customer)->getTable();
        $data = DB::select(DB::raw("SELECT * FROM $table"));
        $data = json_encode($data);
        SELF::data2excel('Excel', 'Sheet1', json_decode($data, true));
    }

    public function data2excel($excel, $sheet, $data)
    {
        $this->excel = $excel;
        $this->sheet = $sheet;
        $this->data = $data;
        Excel::create($this->excel, function ($excel) {
            $excel->sheet('Sheetname', function ($sheet) {
                $sheet->appendRow(array_keys($this->data[0])); // column names
                foreach ($this->data as $field) {
                    $sheet->appendRow($field);
                }
            });
        })->export('xlsx');
    }

    public function html2pdf($html)
    {
        $font_size = 8;
        $pdf = new TCPDF();
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        $pdf->SetFont('times', '', $font_size, '', 'default', true);
        $pdf->AddPage("L");
        $pdf->writeHTML($html);
        $filename = '/report.pdf';
        $pdf->Output($filename, 'I');
    }
}
