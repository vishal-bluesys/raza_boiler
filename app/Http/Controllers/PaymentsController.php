<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    // List all payments
    public function index()
    {
            $query = Payments::query();

            // Filter by usertype
            if (request('usertype')) {
                $query->where('usertype', request('usertype'));
            }
            // Filter by paymenttype
            if (request('paymenttype')) {
                $query->where('paymenttype', request('paymenttype'));
            }
            // Filter by paymentmode
            if (request('paymentmode')) {
                $query->where('paymentmode', request('paymentmode'));
            }
            // Filter by paymentdate
            if (request('paymentdate')) {
                $query->whereDate('paymentdate', request('paymentdate'));
            }

            // Filter by customer/company name
            if (request('name')) {
                $query->where(function ($q) {
                    $name = request('name');
                    $q->whereHas('customerMaster', function ($sub) use ($name) {
                        $sub->where('customer_name', 'like', "%$name%");
                    })
                    ->orWhereHas('companyMaster', function ($sub) use ($name) {
                        $sub->where('company_name', 'like', "%$name%");
                    });
                });
            }

            $payments = $query->with(['customerUser', 'companyUser', 'customerMaster', 'companyMaster'])->get();

            // Add customer/company name to result
            $result = $payments->map(function ($payment) {
                $name = null;
                if ($payment->usertype === 'customer' && $payment->customerMaster) {
                    $name = $payment->customerMaster->customer_name;
                } elseif ($payment->usertype === 'company' && $payment->companyMaster) {
                    $name = $payment->companyMaster->company_name;
                }
                $data = $payment->toArray();
                $data['name'] = $name;
                return $data;
            });
            return response()->json($result);
    }

    // Store a new payment
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usertype' => 'required|in:customer,company',
            'userid' => 'required|integer',
            'paymentamount' => 'required|numeric',
            'paymenttype' => 'required|in:paid,received',
            'paymentmode' => 'required|in:online,cash,cheque',
            'transaction_cheque_no' => 'nullable|string',
            'paymentdate' => 'required|date',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        $payment = Payments::create($validated);
        return response()->json($payment, 201);
    }

    // Show a single payment
    public function show($id)
    {
        $payment = Payments::findOrFail($id);
        return response()->json($payment);
    }

    // Update a payment
    public function update(Request $request, $id)
    {
        $payment = Payments::findOrFail($id);
        $validated = $request->validate([
            'usertype' => 'sometimes|in:customer,company',
            'userid' => 'sometimes|integer',
            'paymentamount' => 'sometimes|numeric',
            'paymenttype' => 'sometimes|in:paid,received',
            'paymentmode' => 'sometimes|in:online,cash,cheque',
            'transaction_cheque_no' => 'nullable|string',
            'paymentdate' => 'sometimes|date',
            'created_by' => 'nullable|integer',
            'updated_by' => 'nullable|integer',
        ]);
        $payment->update($validated);
        return response()->json($payment);
    }

    // Delete a payment
    public function destroy($id)
    {
        $payment = Payments::findOrFail($id);
        $payment->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }

    // Get company or customer list
    public function getEntityList(Request $request)
    {
        $type = $request->query('type');
        if ($type === 'company') {
            $list = \App\Models\CompanyMaster::select('id', 'company_name as name', 'company_name as slug')->get();
        } elseif ($type === 'customer') {
            $list = \App\Models\CustomerMaster::select('id', 'customer_name as name', 'customer_name as slug')->get();
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }
        return response()->json($list);
    }
}
