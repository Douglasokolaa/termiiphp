<?php

namespace Okolaa\TermiiPHP\Resources;

use Okolaa\TermiiPHP\Data\DeviceTemplate;
use Okolaa\TermiiPHP\Data\Message;
use Okolaa\TermiiPHP\Endpoints\Messaging\SendBulkMessageEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\SendDeviceTemplateEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\SendMessageEndpoint;
use Okolaa\TermiiPHP\Endpoints\Messaging\SendMessageFromAutoNumberEndpoint;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;

/**
 * Reference: https://developers.termii.com/messaging
 */
class MessagingResource extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function send(Message $message): Response
    {
        return $this->connector->send(new SendMessageEndpoint($message));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function sendBulk(Message $message): Response
    {
        return $this->connector->send(new SendBulkMessageEndpoint($message));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function SendMessageFromAutoNumber(string $to, string $message): Response
    {
        return $this->connector->send(new SendMessageFromAutoNumberEndpoint($to, $message));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function sendDeviceTemplate(DeviceTemplate $deviceTemplate): Response
    {
        return $this->connector->send(new SendDeviceTemplateEndpoint($deviceTemplate));
    }
}
