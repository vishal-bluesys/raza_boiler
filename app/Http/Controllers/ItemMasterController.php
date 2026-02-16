<?php

namespace App\Http\Controllers;

use App\Models\ItemMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemMasterController extends Controller
{
    public function index()
    {
        return response()->json(ItemMaster::all());
    }

    public function show($id)
    {
        $item = ItemMaster::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        return response()->json($item);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'itemname' => 'required|string',
            'itemslug' => 'required|string|unique:item_master,itemslug',
            'customertypeid' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $item = ItemMaster::create($validated);
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = ItemMaster::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        $validated = $request->validate([
            'itemname' => 'sometimes|required|string',
            'itemslug' => 'sometimes|required|string|unique:item_master,itemslug,' . $id,
            'customertypeid' => 'sometimes|required|integer',
        ]);
        $item->update($validated);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = ItemMaster::find($id);
        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        $item->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
