<?php

namespace Okolaa\TermiiPHP\Resources\Campaign;

use Okolaa\TermiiPHP\Data\Campaign;
use Okolaa\TermiiPHP\Endpoints\Campaign\GetCampaignHistoryEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\GetCampaignsEndpoint;
use Okolaa\TermiiPHP\Endpoints\Campaign\SendCampaignEndpoint;
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
        return $this->connector->send(new SendCampaignEndpoint($campaign));
    }

    public function get(int $page = 1): Response
    {
        return $this->connector->send(new GetCampaignsEndpoint($page));
    }

    public function getHistory(string $campaignId, int $page = 1): Response
    {
        return $this->connector->send(new GetCampaignHistoryEndpoint($campaignId, $page));
    }
}