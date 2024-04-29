<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DaliveryService;
use Illuminate\Http\Request;
use App\Models\DeliveryReport;

class DeliveryReportController extends Controller
{
    public function index(Request $request) {
        $page = 10;

        $filterDate = $request->get('filter_date');
        $filterCustomer = $request->get('filter_customer');
        $filterDelivery = $request->get('filter_delivery');
        $filterTracking = $request->get('filter_tracking');

        $customers = Customer::where('status', 'active')->get();
        $deliveries = DaliveryService::where('status', 'show')->get();

        $deliveryReportFilter = DeliveryReport::orderBy('delivery_date', 'DESC');

        if ($request->get('filter_date')) {
            $deliveryReportFilter->whereDate('delivery_date', '=', $filterDate);
        }

        if ($request->get('filter_customer')) {
            if ($filterCustomer == "other") {
                $deliveryReportFilter->where('customer_id', 0);
            }
            else {
                $deliveryReportFilter->where('customer_id', $filterCustomer);
            }
        }

        if ($request->get('filter_delivery')) {
            $deliveryReportFilter->where('delivery_id', $filterDelivery);
        }

        if ($request->get('filter_tracking')) {
            $deliveryReportFilter->where("delivery_tracking", "like", "%".$filterTracking."%");
        }

        $deliveryReports = $deliveryReportFilter->paginate($page)->withQueryString();

        $deliveryReports->appends(['filter_date' => $request->get('filter_date'),
        'filter_customer' => $request->get('filter_customer'),
        'filter_delivery' => $request->get('filter_delivery'),
        'filter_tracking' => $request->get('filter_tracking')]);

        return view('admin.delivery-report.index',
        compact('deliveryReports', 'customers', 'deliveries', 'filterDate',
        'filterCustomer', 'filterDelivery', 'filterTracking'));
    }

    public function create() {
        $customers = Customer::where('status', 'active')->get();
        $deliveries = DaliveryService::where('status', 'show')->get();
        return view('admin.delivery-report.create', compact('customers', 'deliveries'));
    }

    public function store(Request $request) {
        $request->validate([
            'delivery_date' => 'required',
            'delivery_tracking' => 'required',
            'customer_id' => 'required',
            'delivery_id' => 'required',
            'delivery_amount' => 'required',
        ]);

        $customer = Customer::where('id', $request->customer_id)->first();
        $delivery = DaliveryService::where('id', $request->delivery_id)->first();

        $deliveryReport = new DeliveryReport();
        $deliveryReport->delivery_date = $request->delivery_date;
        $deliveryReport->delivery_tracking = $request->delivery_tracking;
        $deliveryReport->delivery_name = $delivery->name;
        $deliveryReport->delivery_id = $request->delivery_id;
        $deliveryReport->delivery_amount = $request->delivery_amount;

        if ($request->customer_id == "other") {
            $deliveryReport->customer_name = $request->customer_other;
            $deliveryReport->customer_other = $request->customer_other;
            $deliveryReport->customer_id = 0;
        }
        else {
            $deliveryReport->customer_name = $customer->store_name;
            $deliveryReport->customer_id = $request->customer_id;
        }

        $deliveryReport->save();

        return redirect()
            ->action([DeliveryReportController::class, 'index'])
            ->with('success', 'Create Success');
    }

    public function edit($id) {
        $deliveryReport = DeliveryReport::find($id);
        $customers = Customer::where('status', 'active')->get();
        $deliveries = DaliveryService::where('status', 'show')->get();
        return view('admin.delivery-report.edit', compact('deliveryReport', 'customers', 'deliveries'));
    }

    public function update(Request $request) {
        $request->validate([
            'delivery_date' => 'required',
            'delivery_tracking' => 'required',
            'customer_id' => 'required',
            'delivery_id' => 'required',
            'delivery_amount' => 'required',
        ]);

        $customer = Customer::where('id', $request->customer_id)->first();
        $delivery = DaliveryService::where('id', $request->delivery_id)->first();

        $id = $request->id;
        $deliveryReport = DeliveryReport::find($id);
        $deliveryReport->delivery_date = $request->delivery_date;
        $deliveryReport->delivery_tracking = $request->delivery_tracking;
        $deliveryReport->delivery_name = $delivery->name;
        $deliveryReport->delivery_id = $request->delivery_id;
        $deliveryReport->delivery_amount = $request->delivery_amount;

        if ($request->customer_id == "other") {
            $deliveryReport->customer_name = $request->customer_other;
            $deliveryReport->customer_other = $request->customer_other;
            $deliveryReport->customer_id = 0;
        }
        else {
            $deliveryReport->customer_name = $customer->store_name;
            $deliveryReport->customer_id = $request->customer_id;
        }

        $deliveryReport->save();

        return redirect()
            ->action([DeliveryReportController::class, 'index'])
            ->with('success', 'Edit Success');
    }

    public function destroy($id) {
        $deliveryReport = DeliveryReport::find($id);
        $deliveryReport->delete();
        return redirect()->back()->with('success', 'Delete Success');
    }
}
