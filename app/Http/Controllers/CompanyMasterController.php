<?php

namespace App\Http\Controllers;

use App\Models\CompanyMaster;
use App\Models\CompanyUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyMasterController extends Controller
{
    // Require JWT authentication for all methods
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function index()
    {
        return response()->json(CompanyMaster::all());
    }

    public function show($id)
    {
        $company = CompanyMaster::findOrFail($id);
        return response()->json($company);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'company_mobile' => 'nullable|string|unique:company_master,company_mobile',
            'company_email' => 'nullable|email|unique:company_master,company_email',
            'company_owner_name' => 'nullable|string',
            'company_gst_number' => 'nullable|string',
            'company_location' => 'nullable|string',
            'totalpurchaseinkg' => 'nullable|numeric',
            'totalbuisness' => 'nullable|numeric',
            'totalbalance' => 'nullable|numeric',
            'status' => 'required|in:active,inactive',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();

        DB::beginTransaction();
        try {
            $company = CompanyMaster::create($validated);
            // Create user entry
            $user = User::create([
                'name' => $company->company_owner_name ?? $company->company_name,
                'username' => $company->company_name,
                'email' => $company->company_email,
                'mobileno' => $company->company_mobile,
                'status' => $company->status,
                'password' => Hash::make('default123'), // Set default password
            ]);

                // Set company_master_id for one-to-many relationship
                $companyUser = CompanyUser::create([
                    'companyid' => $company->id,
                    'userid' => $user->id,
                ]);

            DB::commit();
            return response()->json($company, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $company = CompanyMaster::findOrFail($id);
        $validated = $request->validate([
            'company_name' => 'sometimes|string',
            'company_mobile' => 'nullable|string',
            'company_email' => 'nullable|email',
            'company_owner_name' => 'nullable|string',
            'company_gst_number' => 'nullable|string',
            'company_location' => 'nullable|string',
            'totalpurchaseinkg' => 'nullable|numeric',
            'totalbuisness' => 'nullable|numeric',
            'totalbalance' => 'nullable|numeric',
            'status' => 'sometimes|in:active,inactive',
        ]);

        DB::beginTransaction();
        try {
            $company->update($validated);
            // Update or create user entry
            $companyUser = CompanyUser::where('companyid', $company->id)->first();
            if ($companyUser) {
                $user = User::find($companyUser->userid);
            } else {
                $user = null;
            }
            if ($user) {
                $user->update([
                    'name' => $company->company_owner_name ?? $company->company_name,
                    'email' => $company->company_email,
                    'mobileno' => $company->company_mobile,
                    'status' => $company->status,
                ]);
            } else {
                User::create([
                    'name' => $company->company_owner_name ?? $company->company_name,
                    'username' => $company->company_name,
                    'email' => $company->company_email,
                    'mobileno' => $company->company_mobile,
                    'status' => $company->status,
                    'password' => Hash::make('default123'),
                ]);
            }
            DB::commit();
            return response()->json($company);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $company = CompanyMaster::findOrFail($id);
        $company->delete();
        // Optionally delete user entry
        User::where('username', $company->company_name)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    public function updateStatus(Request $request, $id)
    {
        $company = CompanyMaster::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:active,inactive',
        ]);
        DB::beginTransaction();
        try {
            $company->update(['status' => $validated['status']]);
            $companyUser = CompanyUser::where('companyid', $company->id)->first();
            if ($companyUser) {
                $user = User::find($companyUser->userid);
                if ($user) {
                    $user->update(['status' => $validated['status']]);
                }
            }
            DB::commit();
            return response()->json($company);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
