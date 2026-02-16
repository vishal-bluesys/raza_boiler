<?php

namespace App\Http\Controllers;

use App\Models\Maintanance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class MaintananceController extends Controller
{
    public function index()
    {
        return response()->json(Maintanance::all());
    }

    public function show($id)
    {
        $maint = Maintanance::find($id);
        if (!$maint) {
            return response()->json(['error' => 'Maintanance record not found'], 404);
        }
        return response()->json($maint);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicleid' => 'required|integer',
            'maintanancetype' => 'required|integer',
            'maintanancecost' => 'required|numeric',
            'maintanancedate' => 'required|date',
            'created_by' => 'required|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $maint = Maintanance::create($validated);
        return response()->json($maint, 201);
    }

    public function update(Request $request, $id)
    {
        $maint = Maintanance::find($id);
        if (!$maint) {
            return response()->json(['error' => 'Maintanance record not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'vehicleid' => 'sometimes|required|integer',
            'maintanancetype' => 'sometimes|required|integer',
            'maintanancecost' => 'sometimes|required|numeric',
            'maintanancedate' => 'sometimes|required|date',
            'created_by' => 'sometimes|required|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $maint->update($validated);
        return response()->json($maint);
    }

    public function destroy($id)
    {
        $maint = Maintanance::find($id);
        if (!$maint) {
            return response()->json(['error' => 'Maintanance record not found'], 404);
        }
        $maint->delete();
        return response()->json(['message' => 'Maintanance record deleted successfully']);
    }
}
