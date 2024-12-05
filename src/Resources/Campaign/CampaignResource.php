<?php

namespace Okolaa\TermiiPHP\Resources\Campaign;

use Okolaa\TermiiPHP\Data\Campaign;
use Okolaa\TermiiPHP\Requests\Campaign\GetCampaignHistoryRequest;
use Okolaa\TermiiPHP\Requests\Campaign\GetCampaignsRequest;
use Okolaa\TermiiPHP\Requests\Campaign\SendCampaignRequest;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class CampaignResource extends BaseResource
{
    public function phoneBook(): PhonebookResource
    {
        return new PhonebookResource($this->connector);
    }

    public function send(Campaign $campaign): Response
    {
        return $this->connector->send(new SendCampaignRequest($campaign));
    }

    public function get(int $page = 1): Response
    {
        return $this->connector->send(new GetCampaignsRequest($page));
    }

    public function getHistory(string $campaignId, int $page = 1): Response
    {
        return $this->connector->send(new GetCampaignHistoryRequest($campaignId, $page));
    }
}