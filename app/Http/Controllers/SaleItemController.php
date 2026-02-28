<?php
namespace App\Http\Controllers;

use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class SaleItemController extends Controller
{
    public function index($id = null)
    {
        if ($id !== null) {
            return response()->json(SaleItem::where('saleid', $id)->get());
        }
        return response()->json(SaleItem::all());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'saleid' => 'required|integer',
            'itemid' => 'required|integer',
            'itemweight' => 'required|numeric',
            'itemqty' => 'required|integer',
            'actualrate' => 'required|numeric',
            'salerate' => 'required|numeric',
            'discounttype' => 'required|in:flat,percent',
            'discount' => 'required|numeric',
            //'totalsale' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }
    
        $validated = $validator->validated();
        // Calculate total sale
        $validated['totalsale'] = $validated['itemweight'] * $validated['salerate'];
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
         $validator = Validator::make($request->all(), [
            'saleid' => 'integer',
            'itemid' => 'integer',
            'itemweight' => 'numeric',
            'itemqty' => 'integer',
            'actualrate' => 'numeric',
            'salerate' => 'numeric',
            'discounttype' => 'in:flat,percent',
            'discount' => 'numeric',
            //'totalsale' => 'numeric',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        // Recalculate total sale if relevant fields are updated
        if (isset($validated['itemweight']) || isset($validated['salerate'])) {
            $validated['totalsale'] = $validated['itemweight'] * $validated['salerate'];
        }
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
