<?php

namespace Okolaa\TermiiPHP\Resources;

use Okolaa\TermiiPHP\Data\SenderId;
use Okolaa\TermiiPHP\Requests\Messaging\GetSenderIdsRequest;
use Okolaa\TermiiPHP\Requests\Messaging\RequestSenderIdRequest;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

/**
 * Templates API helps businesses set a template for the one-time-passwords (pins) sent to their customers via whatsapp or sms.
 */
class SenderIdResource extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function getIds(int $page = 1): Response
    {
        return $this->connector->send(new GetSenderIdsRequest($page));

    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function requestId(SenderId $sender): Response
    {
        return $this->connector->send(new RequestSenderIdRequest($sender));
    }
}