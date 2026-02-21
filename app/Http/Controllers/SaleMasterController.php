<?php
namespace App\Http\Controllers;

use App\Models\SaleMaster;
use Illuminate\Http\Request;

class SaleMasterController extends Controller
{
    public function index()
    {
        return response()->json(SaleMaster::with('saleitems')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customerid' => 'required|integer',
            'saledate' => 'required|date',
            'salestatus' => 'required|in:open,close,reopen',
        ]);
        $sale = SaleMaster::create($validated);
        return response()->json(['message' => 'Sale created', 'data' => $sale], 201);
    }

    public function show($id)
    {
        $sale = SaleMaster::with('saleitems')->find($id);
        if (!$sale) return response()->json(['message' => 'Sale not found'], 404);
        return response()->json($sale);
    }

    public function update(Request $request, $id)
    {
        $sale = SaleMaster::find($id);
        if (!$sale) return response()->json(['message' => 'Sale not found'], 404);
        $validated = $request->validate([
            'customerid' => 'integer',
            'saledate' => 'date',
            'salestatus' => 'in:open,close,reopen',
        ]);
        $sale->update($validated);
        return response()->json(['message' => 'Sale updated', 'data' => $sale]);
    }

    public function destroy($id)
    {
        $sale = SaleMaster::find($id);
        if (!$sale) return response()->json(['message' => 'Sale not found'], 404);
        $sale->delete();
        return response()->json(['message' => 'Sale deleted']);
    }
}
