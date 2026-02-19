<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller{
    public function index()
    {
        return Order::with('items')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customerid' => 'required|integer',
            'orderdate' => 'required|date',
            'orderstatus' => 'required|in:delivered,canceled,intransit',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
            'items' => 'required|array|min:1',
            'items.*.itemid' => 'required|integer',
            'items.*.itemweight' => 'required|numeric',
            'items.*.status' => 'required|in:ordered,canceled',
            'items.*.created_by' => 'nullable|integer',
            'items.*.updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $order = Order::create($validated);
        foreach ($validated['items'] as $item) {
            $item['orderid'] = $order->id;
            Orderitem::create($item);
        }
        return response()->json($order->load('items'), 201);
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return response()->json($order);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'customerid' => 'sometimes|integer',
            'orderdate' => 'sometimes|date',
            'orderstatus' => 'sometimes|in:delivered,canceled,intransit',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $order->update($validated);
        return response()->json($order->load('items'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->items()->delete();
        $order->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'orderstatus' => 'required|in:delivered,canceled,intransit',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $order->update($validator->validated());
        return response()->json($order);
    }
}
