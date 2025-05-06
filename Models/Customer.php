<?php

namespace EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'status',
        'plan_expiry_date'
    ];

    protected $casts = [
        'plan_expiry_date' => 'date',
    ];
}