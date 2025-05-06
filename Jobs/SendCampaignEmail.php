<?php

namespace EmailCampaign\Jobs;

use EmailCampaign\Mail\CampaignMail;
use EmailCampaign\Models\Campaign;
use EmailCampaign\Models\CampaignRecipient;
use EmailCampaign\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCampaignEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Campaign $campaign,
        public Customer $customer
    ) {}

    public function handle(): void
    {
        try {
            Mail::to($this->customer->email)
                ->send(new CampaignMail($this->campaign, $this->customer));

            CampaignRecipient::updateOrCreate(
                [
                    'campaign_id' => $this->campaign->id,
                    'customer_id' => $this->customer->id,
                ],
                [
                    'status' => 'sent',
                    'sent_at' => now(),
                ]
            );
        } catch (\Exception $e) {
            CampaignRecipient::updateOrCreate(
                [
                    'campaign_id' => $this->campaign->id,
                    'customer_id' => $this->customer->id,
                ],
                [
                    'status' => 'failed',
                    'error' => $e->getMessage(),
                ]
            );
        }
    }
}