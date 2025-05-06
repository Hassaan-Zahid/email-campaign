<?php

namespace EmailCampaign\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'email-campaign:install';

    protected $description = 'Install the Email Campaign package';

    public function handle()
    {
        $this->info('Installing Email Campaign package...');

        $this->info('Publishing configuration...');
        $this->call('vendor:publish', [
            '--provider' => 'EmailCampaign\Providers\EmailCampaignServiceProvider',
            '--tag' => 'config'
        ]);

        $this->info('Running migrations...');
        $this->call('migrate');

        $this->info('Email Campaign package installed successfully.');
    }
}