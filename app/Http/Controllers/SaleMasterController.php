<?php
namespace App\Http\Controllers;

use App\Models\ItemMaster;
use App\Models\SaleMaster;
use App\Models\SaleItem;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\RouteBuilder;
use App\Models\RouteStop;
use Illuminate\Http\Request;

class SaleMasterController extends Controller
{
    public function index(Request $request)
    {
        $customerid = $request->query('customerid');
        $saleDate = $request->query('saledate');
        $query = SaleMaster::with('saleitems');
        if ($customerid !== null) {
            $query->where('customerid', $customerid);
        }
        if ($saleDate !== null) {
            $query->whereDate('saledate', $saleDate);
        } 
        return response()->json($query->with('customer')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customerid' => 'required|integer',
            'saledate' => 'required|date',
            'salestatus' => 'required|in:open,close,reopen',
        ]);
        $sale = SaleMaster::create($validated);
        return response()->json(['message' => 'Sale created', 'data' => $sale], 201);
    }

    public function show($id)
    {
        $sale = SaleMaster::with('saleitems')->find($id);
        if (!$sale) return response()->json(['message' => 'Sale not found'], 404);
        return response()->json($sale);
    }

    public function update(Request $request, $id)
    {
        $sale = SaleMaster::find($id);
        if (!$sale) return response()->json(['message' => 'Sale not found'], 404);
        $validated = $request->validate([
            'customerid' => 'integer',
            'saledate' => 'date',
            'salestatus' => 'in:open,close,reopen',
        ]);
        $sale->update($validated);
        return response()->json(['message' => 'Sale updated', 'data' => $sale]);
    }

    public function destroy($id)
    {
        $sale = SaleMaster::find($id);
        if (!$sale) return response()->json(['message' => 'Sale not found'], 404);
        $sale->delete();
        return response()->json(['message' => 'Sale deleted']);
    }

    public function getSaleItems(Request $request)
    {
        
        $customerid = $request->query('customerid');
        $saleDate = $request->query('saledate');
        
        $query = SaleMaster::query();
        if ($customerid !== null) {
            $query->where('customerid', $customerid);
        }
        if ($saleDate !== null) {
            $query->whereDate('saledate', $saleDate);
        } 
        
        $sale = $query->with('saleitems')->first();

        
            $order = Order::query();
            if ($customerid !== null) { 
                $order->where('customerid', $customerid);
            }
            if ($saleDate !== null) {
                $order->whereDate('orderdate', $saleDate);
            }
            $order = $order->with('items')->first();
        
        $deliveryRoute = RouteBuilder::query();
        if ($customerid !== null) {
            $deliveryRoute->whereHas('route_stops', function ($q) use ($customerid) {
                $q->where('customerid', $customerid);
            });
        }
        if ($saleDate !== null) {
            $deliveryRoute->whereDate('deliverydate', $saleDate);
        }
        $deliveryRoute = $deliveryRoute->with('route_stops')->first();    
        //dd($deliveryRoute);
        // create and array to hold the combined data and return it as json response
        // saleitemid, itemid , item name, ordered weight, delivered weight, delivery rate, delivery status 
        // if sale is null then saleitemid is null

        $combinedData = [];
        if ($sale) {
            foreach ($sale->saleitems as $saleItem) {
                $item = $saleItem->item;
                $orderItem = null;
                if ($order) {
                    $orderItem = $order->items->firstWhere('itemid', $saleItem->itemid);
                }
                $routeStop = null;
                if ($deliveryRoute) {
                    $routeStop = $deliveryRoute->route_stops->firstWhere('customerid', $customerid);
                }
                // Prepare the combined data for each sale item
                $combinedData[] = [
                    'saleitemid' => $saleItem->id,
                    'itemid' => $item ? $item->id : null,
                    'itemname' => $item ? $item->name : null,
                    'orderedweight' => $orderItem ? $orderItem->weight : 0,
                    'deliveredweight' => 0, // Default value, would be set based on delivery data
                    'deliveryrate' => 0, // Default value, would be set based on delivery data
                    'deliverystatus' => 'pending', // Default status, would be set based on delivery data
                ];
            }
        }
        if ($order && !$sale) {
            foreach ($order->items as $orderItem) {
                $item = $orderItem->item;
                
                $routeStop = null;
                if ($deliveryRoute) {
                    $routeStop = $deliveryRoute->route_stops->firstWhere('customerid', $customerid);
                }
                                
                // Prepare the combined data for each order item that doesn't have a corresponding sale item
                $combinedData[] = [
                    'saleitemid' => null,
                    'itemid' => $item ? $item->id : null,
                    'itemname' => $item ? $item->itemname : null,
                    'orderedweight' => $orderItem->itemweight,
                    'deliveredweight' => $routeStop ? $routeStop->itemweight : 0, // Default value, would be set based on delivery data
                    'deliveryrate' => $routeStop ? $routeStop->rateofsale : 0, // Default value, would be set based on delivery data
                    'deliverystatus' => $routeStop ? $routeStop->status : 'pending', // Default status, would be set based on delivery data
                ];
            }
        }

        return response()->json($combinedData);
    }
    
}
