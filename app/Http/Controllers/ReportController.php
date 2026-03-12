<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SaleReportExport;
use App\Exports\PurchaseReportExport;
use App\Models\SaleMaster;
use App\Models\Company;
use App\Models\SaleItem;
use App\Models\Purchasemaster;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Item;
use App\Models\ItemMaster;
use App\Models\Maintanance;
use App\Models\MaintananceType;
use App\Models\User;


class ReportController extends Controller
{
    // Sales Report
    public function salesReport(Request $request)
    {
        $query = SaleMaster::with(['customer', 'saleitems.item']);
        // Filters
        if ($request->filled('customerid')) {
            $query->where('customerid', $request->customerid);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('saledate', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('itemid')) {
            $query->whereHas('saleitems', function ($q) use ($request) {
                $q->where('itemid', $request->itemid);
            });
        }
        $sales = $query->get();
        
        $data = [];
        foreach ($sales as $sale) {
            foreach ($sale->saleitems as $item) {
           
            $data[] = [
                  'customername'=>  $sale->customer->customer_name ?? '',
                    'itemname'=> $item->item->itemname ?? '',
                    'saledate'=> date('d-m-Y', strtotime($sale->saledate)) ?? $sale->saledate,
                    'weight'=> $item->itemweight,
                    'rate'=> $item->salerate,
                    'total'=> $item->itemweight * $item->salerate,
                ];
            }
        }
        if ($request->filled('export') && $request->export == 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\SaleReportExport($data), 'sales_report.xlsx');
        }
        return response()->json(['data' => $data]);
    }

    // Purchase Report
    public function purchaseReport(Request $request)
    {
        $query = \App\Models\Purchasemaster::with('company');
        // Filters
        if ($request->filled('companyid')) {
            $query->where('companyid', $request->companyid);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('purchasedate', [$request->start_date, $request->end_date]);
        }
        $purchases = $query->with('company')->get();
        $data = [];
        foreach ($purchases as $purchase) {
            $data[] = [
                'company_name' => $purchase->company->company_name ?? '',
                'purchasedate' => $purchase->purchasedate,
                'parchaseweight' => $purchase->parchaseweight,
                'rateofpurchase' => $purchase->rateofpurchase,
                'total_amount' => $purchase->parchaseweight * $purchase->rateofpurchase,
            ];
        }
        if ($request->filled('export') && $request->export == 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PurchaseReportExport($data), 'purchase_report.xlsx');
        }
        return response()->json(['data' => $data]);
    }

    // Maintanance Report
    public function maintananceReport(Request $request)
    {
        $query = \App\Models\Maintanance::query();
        // Filters
        if ($request->filled('driverid')) {
            $query->where('created_by', $request->driverid);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('maintanancedate', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('itemid')) {
            $query->where('maintanancetype', $request->itemid);
        }
        $maintanances = $query->with('maintainancetype', 'vehicle')->get();
        $data = [];
        foreach ($maintanances as $m) {
            $driverName = '';
            if ($m->created_by) {
                $driver = \App\Models\User::find($m->created_by);
                $driverName = $driver ? $driver->name : '';
            }
            $data[] = [
                'driver_name' => $driverName,
                'vehicle_number' => $m->vehicle ? $m->vehicle->rcnumber : '',
                'maintanancedate' => $m->maintanancedate,
                'maintanancetype' => $m->maintainancetype ? $m->maintainancetype->maintanancetype : '',
                'maintanancecost' => $m->maintanancecost,
            ];
        }
        if ($request->filled('export') && $request->export == 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\MaintananceReportExport($data), 'maintanance_report.xlsx');
        }
        return response()->json(['data' => $data]);
    }

    // Order Report
    public function orderReport(Request $request)
    {
        $query = \App\Models\Order::with(['customer', 'items.item']);
        // Filters
        if ($request->filled('customerid')) {
            $query->where('customerid', $request->customerid);
        }
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('orderdate', [$request->start_date, $request->end_date]);
        }
        if ($request->filled('itemid')) {
            $query->whereHas('items', function ($q) use ($request) {
                $q->where('itemid', $request->itemid);
            });
        }
        $orders = $query->get();
        $data = [];
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $data[] = [
                    'customer_name' => $order->customer->customer_name ?? '',
                    'itemname' => $item->item->itemname ?? '',
                    'orderdate' => $order->orderdate,
                    'itemweight' => $item->itemweight,
                ];
            }
        }
        if ($request->filled('export') && $request->export == 'excel') {
            return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\OrderReportExport($data), 'order_report.xlsx');
        }
        return response()->json(['data' => $data]);
    }
}
