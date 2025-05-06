<?php

namespace EmailCampaign\Mail;

use EmailCampaign\Models\Campaign;
use EmailCampaign\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Campaign $campaign,
        public Customer $customer
    ) {}

    public function build()
    {
        return $this->subject($this->campaign->subject)
            ->view('email-campaign::emails.campaign')
            ->with([
                'body' => str_replace(
                    '{{name}}',
                    $this->customer->name,
                    $this->campaign->body
                ),
                'campaign' => $this->campaign,
                'customer' => $this->customer,
            ]);
    }
}