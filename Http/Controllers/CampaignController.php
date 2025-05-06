<?php

namespace EmailCampaign\Http\Controllers;

use EmailCampaign\Http\Requests\CampaignRequest;
use EmailCampaign\Http\Requests\AttachRecipientsRequest;
use EmailCampaign\Models\Campaign;
use EmailCampaign\Services\CampaignService;
use Illuminate\Http\JsonResponse;

class CampaignController extends Controller
{
    protected $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function index(): JsonResponse
    {
        $campaigns = Campaign::all();
        return response()->json($campaigns);
    }

    public function store(CampaignRequest $request): JsonResponse
    {
        $campaign = $this->campaignService->createCampaign($request->validated());
        return response()->json($campaign, 201);
    }

    public function show(Campaign $campaign): JsonResponse
    {
        return response()->json($campaign->load('recipients'));
    }

    public function send($campaignId)
    {
        try {
            $campaign = Campaign::findOrFail($campaignId);
            $this->campaignService->sendCampaign($campaign);

            return response()->json(['message' => 'Campaign is being sent']);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }


    public function getRecipients($campaignId)
    {
        $campaign = Campaign::findOrFail($campaignId);

        $recipients = $campaign->recipients()->get();

        return response()->json([
            'recipients' => $recipients,
            'count' => $recipients->count()
        ]);
    }

    public function attachRecipients($campaignId, AttachRecipientsRequest $request)
    {
        $campaign = Campaign::findOrFail($campaignId);

        $validated = $request->validated();

        $campaign->recipients()->syncWithoutDetaching($validated['customer_ids']);

        return response()->json([
            'message' => 'Recipients attached successfully',
            'count' => $campaign->recipients()->count()
        ]);
    }
}