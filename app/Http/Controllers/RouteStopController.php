<?php

namespace App\Http\Controllers;

use App\Models\RouteStop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RouteStopController extends Controller
{
    public function index()
    {
        return RouteStop::all();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'routeid' => 'required|integer',
            'customerid' => 'required|integer',
            'itemid' => 'required|integer',
            'itemqty' => 'required|numeric',
            'itemweight' => 'required|numeric',
            'rateofsale' => 'nullable|numeric',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $routeStop = RouteStop::create($validator->validated());
        return response()->json($routeStop, 201);
    }

    public function show($id)
    {
        $routeStop = RouteStop::findOrFail($id);
        return response()->json($routeStop);
    }

    public function update(Request $request, $id)
    {
        $routeStop = RouteStop::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'routeid' => 'sometimes|integer',
            'customerid' => 'sometimes|integer',
            'itemid' => 'sometimes|integer',
            'itemqty' => 'sometimes|numeric',
            'itemweight' => 'sometimes|numeric',
            'rateofsale' => 'nullable|numeric',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $routeStop->update($validator->validated());
        return response()->json($routeStop);
    }

    public function destroy($id)
    {
        $routeStop = RouteStop::findOrFail($id);
        $routeStop->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $routeStop = RouteStop::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:delivered,canceled,intransit',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $routeStop->update($validator->validated());
        return response()->json($routeStop);
    }
}
