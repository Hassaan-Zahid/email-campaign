<?php

namespace EmailCampaign\Services;

use EmailCampaign\Jobs\SendCampaignEmail;
use EmailCampaign\Mail\CampaignMail;
use EmailCampaign\Models\Campaign;
use EmailCampaign\Models\Customer;
use Illuminate\Support\Facades\Mail;

class CampaignService
{
    public function createCampaign(array $data): Campaign
    {
        return Campaign::create($data);
    }

    public function sendCampaign(Campaign $campaign)
    {
        $recipients = $campaign->recipients()
            ->wherePivot('status', '!=', 'sent')
            ->get();

        if ($recipients->isEmpty()) {
            throw new \Exception('No new recipients to send the campaign to. Please attach some customers to a campaign');
        }

        foreach ($recipients as $recipient) {
            SendCampaignEmail::dispatch($campaign, $recipient);
        }
    }


    public function addRecipients(Campaign $campaign, array $customerIds): void
    {
        $campaign->recipients()->syncWithoutDetaching($customerIds);
    }
}