<?php

namespace App\Http\Controllers;

use App\Models\MaitainanceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaitainanceTypeController extends Controller
{
    public function index()
    {
        return response()->json(MaitainanceType::all());
    }

    public function show($id)
    {
        $type = MaitainanceType::find($id);
        if (!$type) {
            return response()->json(['error' => 'Maitainance type not found'], 404);
        }
        return response()->json($type);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maintanancetype' => 'required|string|unique:maitainance_types,maintanancetype',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $type = MaitainanceType::create($validated);
        return response()->json($type, 201);
    }

    public function update(Request $request, $id)
    {
        $type = MaitainanceType::find($id);
        if (!$type) {
            return response()->json(['error' => 'Maitainance type not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'maintanancetype' => 'sometimes|required|string|unique:maitainance_types,maintanancetype,' . $id,
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $type->update($validated);
        return response()->json($type);
    }

    public function destroy($id)
    {
        $type = MaitainanceType::find($id);
        if (!$type) {
            return response()->json(['error' => 'Maitainance type not found'], 404);
        }
        $type->delete();
        return response()->json(['message' => 'Maitainance type deleted successfully']);
    }
}
