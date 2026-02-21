<?php
namespace App\Http\Controllers;

use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{
    public function index()
    {
        return response()->json(SaleItem::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'saleid' => 'required|integer',
            'itemid' => 'required|integer',
            'itemweight' => 'required|numeric',
            'itemqty' => 'required|integer',
            'actualrate' => 'required|numeric',
            'salerate' => 'required|numeric',
            'discounttype' => 'required|in:flat,percent',
            'discount' => 'required|numeric',
            'totalsale' => 'required|numeric',
        ]);
        $item = SaleItem::create($validated);
        return response()->json(['message' => 'Sale item created', 'data' => $item], 201);
    }

    public function show($id)
    {
        $item = SaleItem::find($id);
        if (!$item) return response()->json(['message' => 'Sale item not found'], 404);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $item = SaleItem::find($id);
        if (!$item) return response()->json(['message' => 'Sale item not found'], 404);
        $validated = $request->validate([
            'saleid' => 'integer',
            'itemid' => 'integer',
            'itemweight' => 'numeric',
            'itemqty' => 'integer',
            'actualrate' => 'numeric',
            'salerate' => 'numeric',
            'discounttype' => 'in:flat,percent',
            'discount' => 'numeric',
            'totalsale' => 'numeric',
        ]);
        $item->update($validated);
        return response()->json(['message' => 'Sale item updated', 'data' => $item]);
    }

    public function destroy($id)
    {
        $item = SaleItem::find($id);
        if (!$item) return response()->json(['message' => 'Sale item not found'], 404);
        $item->delete();
        return response()->json(['message' => 'Sale item deleted']);
    }
}
