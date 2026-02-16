<?php

namespace App\Http\Controllers;

use App\Models\VehicleMaster;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class VehicleMasterController extends Controller
{
    // List all vehicles
    public function index()
    {
        return response()->json(VehicleMaster::all());
    }

    // Show a single vehicle
    public function show($id)
    {
        $vehicle = VehicleMaster::find($id);
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
        return response()->json($vehicle);
    }

    // Create a new vehicle
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'vehicletype' => 'required|string',
            'vehicalid' => 'required|string|unique:vehiclemaster,vehicalid',
            'rcnumber' => 'required|string',
            'vehicalmodel' => 'required|string',
            'ownername' => 'required|string',
            'owneraddress' => 'required|string',
            'dateofjoining' => 'required|date',
            'contactpersonname' => 'required|string',
            'contactperson_number' => 'required|string',
            'created_by' => 'required|integer',
            'updated_by' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $vehicle = VehicleMaster::create($validated);
        return response()->json($vehicle, 201);
    }

    // Update a vehicle
    public function update(Request $request, $id)
    {
        $vehicle = VehicleMaster::find($id);
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
        $validated = $request->validate([
            'vehicletype' => 'sometimes|required|string',
            'vehicalid' => 'sometimes|required|string|unique:vehiclemaster,vehicalid,' . $id,
            'rcnumber' => 'sometimes|required|string',
            'vehicalmodel' => 'sometimes|required|string',
            'ownername' => 'sometimes|required|string',
            'owneraddress' => 'sometimes|required|string',
            'dateofjoining' => 'sometimes|required|date',
            'contactpersonname' => 'sometimes|required|string',
            'contactperson_number' => 'sometimes|required|string',
            'created_by' => 'sometimes|required|integer',
            'updated_by' => 'nullable|integer',
        ]);
        $vehicle->update($validated);
        return response()->json($vehicle);
    }

    // Delete a vehicle
    public function destroy($id)
    {
        $vehicle = VehicleMaster::find($id);
        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }
        $vehicle->delete();
        return response()->json(['message' => 'Vehicle deleted successfully']);
    }
}
