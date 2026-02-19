<?php

namespace App\Http\Controllers;

use App\Models\Orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderitemController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            return Orderitem::where('orderid', $id)->get();
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orderid' => 'required|integer',
            'itemid' => 'required|integer',
            'itemweight' => 'required|numeric',
            'status' => 'required|in:ordered,canceled',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $orderitem = Orderitem::create($validated);
        return response()->json($orderitem, 201);
    }

    public function show($id)
    {
        $orderitem = Orderitem::findOrFail($id);
        return response()->json($orderitem);
    }

    public function update(Request $request, $id)
    {
        $orderitem = Orderitem::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'orderid' => 'sometimes|integer',
            'itemid' => 'sometimes|integer',
            'itemweight' => 'sometimes|numeric',
            'status' => 'sometimes|in:ordered,canceled',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $orderitem->update($validated);
        return response()->json($orderitem);
    }

    public function destroy($id)
    {
        $orderitem = Orderitem::findOrFail($id);
        $orderitem->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    public function updateStatus(Request $request, $id)
    {
        $orderitem = Orderitem::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:ordered,canceled',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $orderitem->update($validator->validated());
        return response()->json($orderitem);
    }
}