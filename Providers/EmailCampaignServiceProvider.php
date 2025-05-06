<?php

namespace EmailCampaign\Providers;

use Illuminate\Support\ServiceProvider;

class EmailCampaignServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/email-campaign.php', 'email-campaign');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'email-campaign');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/email-campaign.php' => config_path('email-campaign.php'),
            ], 'config');
        }
    }
}