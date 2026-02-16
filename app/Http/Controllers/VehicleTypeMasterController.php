<?php

namespace App\Http\Controllers;

use App\Models\VehicleTypeMaster;
use Illuminate\Http\Request;

class VehicleTypeMasterController extends Controller
{
    // List all vehicle types
    public function index()
    {
        return response()->json(VehicleTypeMaster::all());
    }

    // Show a single vehicle type
    public function show($id)
    {
        $type = VehicleTypeMaster::find($id);
        if (!$type) {
            return response()->json(['error' => 'Vehicle type not found'], 404);
        }
        return response()->json($type);
    }

    // Create a new vehicle type
    public function store(Request $request)
    {
        $validated = $request->validate([
            'vehicletype' => 'required|string|unique:vehicle_type_masters,vehicletype',
        ]);
        $type = VehicleTypeMaster::create($validated);
        return response()->json($type, 201);
    }

    // Update a vehicle type
    public function update(Request $request, $id)
    {
        $type = VehicleTypeMaster::find($id);
        if (!$type) {
            return response()->json(['error' => 'Vehicle type not found'], 404);
        }
        $validated = $request->validate([
            'vehicletype' => 'sometimes|required|string|unique:vehicle_type_masters,vehicletype,' . $id,
        ]);
        $type->update($validated);
        return response()->json($type);
    }

    // Delete a vehicle type
    public function destroy($id)
    {
        $type = VehicleTypeMaster::find($id);
        if (!$type) {
            return response()->json(['error' => 'Vehicle type not found'], 404);
        }
        $type->delete();
        return response()->json(['message' => 'Vehicle type deleted successfully']);
    }
}
