<?php

namespace App\Http\Controllers;

use App\Models\RouteBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteBuilderController extends Controller
{
    // Get routes filtered by type, vehicleid, and driverid
    public function filter(Request $request)
    {
        $query = RouteBuilder::query();
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        if ($request->has('vehicleid')) {
            $query->where('vehicleid', $request->vehicleid);
        }
        if ($request->has('driverid')) {
            $query->where('driverid', $request->driverid);
        }
        return response()->json($query->with('route_stops', 'vehicle', 'driver')
            ->get());
    }
    public function index()
    {
        return RouteBuilder::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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
}
