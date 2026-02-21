<?php

namespace App\Http\Controllers;

use App\Models\Purchasemaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class PurchasemasterController extends Controller
{
    public function index()
    {
        return Purchasemaster::with('company')->get();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'companyid' => 'required|integer',
            'purchasedate' => 'required|date',
            'purchaseqty' => 'required|numeric',
            'parchaseweight' => 'required|numeric',
            'rateofpurchase' => 'nullable|numeric',
            'status' => 'required|in:open,close,reopen',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();

        $purchasemaster = Purchasemaster::create($validated);
        return response()->json($purchasemaster, 201);
    }

    public function show($id)
    {
        $purchasemaster = Purchasemaster::with('company')->findOrFail($id);
        return response()->json($purchasemaster);
    }

    public function update(Request $request, $id)
    {
        $purchasemaster = Purchasemaster::findOrFail($id);
         $validator = Validator::make($request->all(), [
            'companyid' => 'sometimes|integer',
            'purchasedate' => 'sometimes|date',
            'purchaseqty' => 'sometimes|numeric',
            'parchaseweight' => 'sometimes|numeric',
            'rateofpurchase' => 'nullable|numeric',
            'status' => 'sometimes|in:open,close,reopen',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();   
        $purchasemaster->update($validated);
        return response()->json($purchasemaster);
    }

    public function destroy($id)
    {
        $purchasemaster = Purchasemaster::findOrFail($id);
        $purchasemaster->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}
