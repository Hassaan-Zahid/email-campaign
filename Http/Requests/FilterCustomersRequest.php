<?php

namespace EmailCampaign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterCustomersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'sometimes|in:Paid,Grace period,Expired',
            'expires_within_days' => 'sometimes|integer|min:1',
        ];
    }
}