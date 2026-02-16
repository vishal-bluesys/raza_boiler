<?php

namespace App\Http\Controllers;

use App\Models\CustomerMaster;
use App\Models\CustomerType;
use App\Models\CustomerUser;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    // List all customers
    public function index()
    {
        return response()->json(CustomerMaster::all());
    }

    // Show a single customer
    public function show($id)
    {
        $customer = CustomerMaster::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    // Create a new customer
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string',
            'customer_typeid' => 'required|integer',
            'customer_mobile' => 'required|string|unique:customer_master,customer_mobile',
            'customer_email' => 'required|email|unique:customer_master,customer_email',
            'customer_owner_name' => 'nullable|string',
            'customer_alternate_number' => 'nullable|string',
            'customer_location' => 'nullable|string',
            'totalsaleinkg' => 'nullable|numeric',
            'totalbuisness' => 'nullable|numeric',
            'totalbalance' => 'nullable|numeric',
            'status' => 'sometimes|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();

        // Create customer
        $customer = CustomerMaster::create($validated);

        // Create user
        $user = User::create([
            'name' => $validated['customer_name'],
            'username' => $validated['customer_name'],
            'email' => $validated['customer_email'],
            'password' => Hash::make('default123'), // Set a default password or generate one
            'mobileno' => $validated['customer_mobile'],
            'status' => $validated['status'] ?? 1,
        ]);

        // Link customer and user
        CustomerUser::create([
            'customerid' => $customer->id,
            'userid' => $user->id,
            'created_at' => now(),
        ]);

        return response()->json(['customer' => $customer, 'user' => $user], 201);
    }

    // Update a customer
    public function update(Request $request, $id)
    {
        $customer = CustomerMaster::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        $validated = $request->validate([
            'customer_name' => 'sometimes|string',
            'customer_typeid' => 'sometimes|integer',
            'customer_mobile' => 'nullable|string',
            'customer_owner_name' => 'nullable|string',
            'customer_alternate_number' => 'nullable|string',
            'customer_location' => 'nullable|string',
            'totalsaleinkg' => 'nullable|numeric',
            'totalbuisness' => 'nullable|numeric',
            'totalbalance' => 'nullable|numeric',
            'status' => 'sometimes|in:active,inactive'
        ]);
        
        $customer->update($validated);
        $customerUser = CustomerUser::where('customerid', $customer->id)->first();
        if ($customerUser) {
            $user = User::find($customerUser->userid);
            if ($user) {
                $user->update([
                    'name' => $validated['customer_name'] ?? $customer->customer_name,
                    'email' => $validated['customer_email'] ?? $customer->customer_email,
                    'mobileno' => $validated['customer_mobile'] ?? $customer->customer_mobile,
                    'status' => $validated['status'] ?? $customer->status,
                ]);
            }
        }

        return response()->json($customer);
    }

    // Delete a customer
    public function destroy($id)
    {
        $customer = CustomerMaster::find($id);
        if (!$customer) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
        $customer->delete();
        return response()->json(['message' => 'Customer deleted']);
    }

    // Get all customer types
    public function customerTypes()
    {
        return response()->json(CustomerType::all());
    }

   public function updateStatus(Request $request, $id)
    {
        $customer = CustomerMaster::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:active,inactive',
        ]);
        DB::beginTransaction();
        try {
            $customer->update(['status' => $validated['status']]);
            $customerUser = CustomerUser::where('customerid', $customer->id)->first();
            if ($customerUser) {
                $user = User::find($customerUser->userid);
                if ($user) {
                    $user->update(['status' => $validated['status']]);
                }
            }
            DB::commit();
            return response()->json($customer);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
