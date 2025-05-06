<?php

namespace EmailCampaign\Http\Controllers;

use EmailCampaign\Http\Requests\FilterCustomersRequest;
use EmailCampaign\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index(FilterCustomersRequest $request): JsonResponse
    {
        $query = Customer::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('expires_within_days')) {
            $days = (int) $request->expires_within_days;
            $query->whereBetween('plan_expiry_date', [
                now(),
                now()->addDays($days)
            ]);
        }

        $customers = $query->get();
        return response()->json($customers);
    }
}