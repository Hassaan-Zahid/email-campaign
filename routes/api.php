<?php

use EmailCampaign\Http\Controllers\CampaignController;
use EmailCampaign\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/email-campaign')->group(function () {
    // Customer routes
    Route::get('customers', [CustomerController::class, 'index']);

    // Campaign routes
    Route::apiResource('campaigns', CampaignController::class);
    Route::get('campaigns/{campaign}/recipients', [CampaignController::class, 'getRecipients']);
    Route::post('campaigns/{campaign}/attach-recipients', [CampaignController::class, 'attachRecipients']);
    Route::post('campaigns/{campaign}/send', [CampaignController::class, 'send']);
});