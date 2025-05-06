<?php

namespace EmailCampaign\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachRecipientsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:customers,id'
        ];
    }
}