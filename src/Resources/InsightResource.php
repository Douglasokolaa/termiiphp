<?php

namespace Okolaa\TermiiPHP\Resources;

use Okolaa\TermiiPHP\Endpoints\Insight\GetBalanceEndpoint;
use Okolaa\TermiiPHP\Endpoints\Insight\HistoryEndpoint;
use Okolaa\TermiiPHP\Endpoints\Insight\PhoneNumberStatusEndpoint;
use Okolaa\TermiiPHP\Endpoints\Insight\SearchPhoneNumberEndpoint;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

class InsightResource extends BaseResource
{
    public function getBalance(): Response
    {
        return $this->connector->send(new GetBalanceEndpoint());
    }

    public function searchPhoneNumber(string $phoneNumber): Response
    {
        return $this->connector->send(new SearchPhoneNumberEndpoint($phoneNumber));
    }

    public function statusOfPhoneNumber(string $phoneNumber, string $countryCode): Response
    {
        return $this->connector->send(new PhoneNumberStatusEndpoint($phoneNumber, $countryCode));
    }

    public function history(?string $messageId = null): Response
    {
        return $this->connector->send(new HistoryEndpoint($messageId));
    }
}
