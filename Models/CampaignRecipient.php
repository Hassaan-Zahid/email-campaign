<?php

namespace EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignRecipient extends Model
{
    protected $table = 'campaign_recipients';

    protected $fillable = [
        'campaign_id',
        'customer_id',
        'status',
        'sent_at',
        'error'
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];
}