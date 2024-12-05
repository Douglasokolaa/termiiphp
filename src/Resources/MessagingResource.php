<?php

namespace Okolaa\TermiiPHP\Resources;

use Okolaa\TermiiPHP\Data\DeviceTemplate;
use Okolaa\TermiiPHP\Data\Message;
use Okolaa\TermiiPHP\Requests\Messaging\SendBulkMessageRequest;
use Okolaa\TermiiPHP\Requests\Messaging\SendDeviceTemplateRequest;
use Okolaa\TermiiPHP\Requests\Messaging\SendMessageFromAutoNumberRequest;
use Okolaa\TermiiPHP\Requests\Messaging\SendMessageRequest;
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
        return $this->connector->send(new SendMessageRequest($message));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function sendBulk(Message $message): Response
    {
        return $this->connector->send(new SendBulkMessageRequest($message));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function SendMessageFromAutoNumber(string $to, string $message): Response
    {
        return $this->connector->send(new SendMessageFromAutoNumberRequest($to, $message));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function sendDeviceTemplate(DeviceTemplate $deviceTemplate): Response
    {
        return $this->connector->send(new SendDeviceTemplateRequest($deviceTemplate));
    }
}