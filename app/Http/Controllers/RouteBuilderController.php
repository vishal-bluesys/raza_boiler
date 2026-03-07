<?php

namespace App\Http\Controllers;

use App\Models\RouteBuilder;
use App\Models\Maintanance;
use App\Models\VehiclePurchase;
use App\Models\Purchasemaster;
use App\Models\RouteMaintainance;
use App\Models\CompanyMaster;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RouteBuilderController extends Controller
{
    // Get routes filtered by type, vehicleid, and driverid
    public function filter(Request $request)
    {
        //get logged in user role
        $user = auth()->user();
        $role = $user->getRoleNames();
        $query = RouteBuilder::query();
        
        //if user role not admin , owner , manager then show assigned routes of selected date otherwise show all routes of selected date
        if(in_array($role[0], ['admin', 'owner', 'manager'])){
           
        
            if ($request->has('type')) {
                $query->where('type', $request->type);
            }else{
            $query->where('type', 'fixed')->whereHas('route_stops.customer', function ($q) {
                        $q->where('customer_typeid', 2); // Assuming 1 is the ID for hotel customers
                });
            }
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }
            if ($request->has('vehicleid')) {
            $query->where('vehicleid', $request->vehicleid);
            }
            if ($request->has('driverid')) {
                $query->where('driverid', $request->driverid);
            }
        }else{
                $query->where('driverid', $user->id);
        }

        if ($request->has('deliverydate')) {
            $query->whereDate('deliverydate', $request->deliverydate);
        }else{
            $query->whereDate('deliverydate', date('Y-m-d'));
        }
        
       
        $routes =  $query->with('route_stops', 'vehicle', 'driver')
                         ->get();

        foreach ($routes as $route) {
            $fuelCost = RouteMaintainance::with('maintanance')->where('routeid', $route->id)
                                        ->where('maintanancetype', 1) // Fuel
                                        ->first();
            $route->fuel = $fuelCost->maintanance->maintanancecost ?? 0;
            $allowanceCost = RouteMaintainance::with('maintanance')->where('routeid', $route->id)
                                        ->where('maintanancetype', 2) // Allowance
                                        ->first();
            $route->allowance = $allowanceCost->maintanance->maintanancecost ?? 0;

          }
        return response()->json($routes);
    }

    public function index()
    {
        return RouteBuilder::all();
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'routename' => 'nullable|string|max:255',
            'vehicleid' => 'required|integer',
            'driverid' => 'required|integer',
            'deliverydate' => 'required|date',
            'status' => 'required|in:delivered,canceled,intransit',
            'type' => 'required|in:fixed,variable',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);

        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        
        
        $routeBuilder = RouteBuilder::create($validator->validated());
        $fuel = $request->input('fuel', 0);
        $fuelMaintnance = Maintanance::create([
            'vehicleid' => $routeBuilder->vehicleid,
            'maintanancetype' => 1, // Assuming 1 is the ID for fuel maintenance
            'maintanancecost' => $fuel,
            'maintanancedate' => date('Y-m-d'),
            'created_by' => $routeBuilder->created_by,
        ]);
        RouteMaintainance::create([
            'vehicleid' => $routeBuilder->vehicleid,
            'maintananceid' => $fuelMaintnance->id,
            'maintanancetype' => 1, // Fuel
            'routeid' => $routeBuilder->id,
        ]);
        $allowance = $request->input('allowance', 0);
        if ($allowance > 0) {
            $allowanceMaintnance = Maintanance::create([
                'vehicleid' => $routeBuilder->vehicleid,
                'maintanancetype' => 2, // Assuming 2 is the ID for allowance maintenance
                'maintanancecost' => $allowance,
                'maintanancedate' => date('Y-m-d'),
                'created_by' => $routeBuilder->created_by,
            ]);
            RouteMaintainance::create([
                'vehicleid' => $routeBuilder->vehicleid,
                'maintananceid' => $allowanceMaintnance->id,
                'maintanancetype' => 2, // Allowance
                'routeid' => $routeBuilder->id,
            ]);

        }
        
        return response()->json($routeBuilder, 201);
    }

    public function show($id)
    {
        $routeBuilder = RouteBuilder::with('route_stops')->findOrFail($id);
        return response()->json($routeBuilder);
    }

    public function update(Request $request, $id)
    {
        $routeBuilder = RouteBuilder::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'routename' => 'nullable|string|max:255',    
            'vehicleid' => 'sometimes|integer',
            'driverid' => 'sometimes|integer',
            'deliverydate' => 'sometimes|date',
            'status' => 'sometimes|in:delivered,canceled,intransit',
            'type' => 'sometimes|in:fixed,variable',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $routeBuilder->update($validator->validated());
        return response()->json($routeBuilder);
    }

    public function destroy($id)
    {
        $routeBuilder = RouteBuilder::findOrFail($id);
        $routeBuilder->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $routeBuilder = RouteBuilder::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:delivered,canceled,intransit',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $routeBuilder->update($validator->validated());
        return response()->json($routeBuilder);
    }

    public function getRoutePurchaseDetails($id)
    {
        $routePurchases = VehiclePurchase::with('purchasemaster')->where('routeid', $id)->get();
        foreach ($routePurchases as $purchase) {
          
          $companyData = CompanyMaster::where('id', $purchase->purchasemaster->companyid)->first();
          $purchase->companyname = $companyData ? $companyData->company_name : 'Unknown';
          $purchase->purchaseqty = $purchase->purchasemaster->purchaseqty ?? 0; // Add purchase quantity to the purchase details
          $purchase->parchaseweight = $purchase->purchasemaster->parchaseweight ?? 0; // Add purchase weight to the purchase details
          $purchase->rateofpurchase = $purchase->purchasemaster->rateofpurchase ?? 0; // Add rate of purchase to the purchase details
          $purchase->purchasedate = $purchase->purchasemaster->purchasedate ?? null; // Add purchase date to the purchase details
          $purchase->status = $purchase->purchasemaster->status ?? null; // Add purchase status to the purchase details  
        }
        return response()->json($routePurchases);
    }

    public function deliveryUsers()
    {
        $deliveryUsers = User::whereHas('roles', function ($q) {
            $q->whereIn('name', ['delivery']);
        })->get();
        return response()->json($deliveryUsers);
    }
}
