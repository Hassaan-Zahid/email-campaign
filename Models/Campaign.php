<?php

namespace EmailCampaign\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'subject',
        'body'
    ];

    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'campaign_recipients')
            ->withPivot('status', 'sent_at', 'error')
            ->withTimestamps();
    }
}