<?php

namespace Okolaa\TermiiPhp;

use GuzzleHttp\Client;
/**
 * Termii APi Library for PHP
 * @author Douglas Okolaa
 */
class Termii
{
    protected $senderId;
    protected $maxAttempts = 3;
    protected $pinTimeToLive = 0;
    protected $pinLength = 6;
    protected $pinPlaceholder = "< _pin_ >";
    protected $pinType = "NUMERIC";
    protected $channel = "generic";
    protected $tokenMessageType = "ALPHANUMERIC";
    protected $messageType = "plain";
    protected $response;
    protected $payload = [];

    /**
     * Termii constructor.
     */
    public function __construct($senderId = 'N-Alert', $apiKey = '')
    {
        $this->senderId = $senderId;
        $this->payload = ["api_key" => $apiKey];
    }

    /**
     * Initialize client
     * @return Client
     */
    protected function client()
    {
        return new Client(['base_uri' => $this->getBaseURI()]);
    }

    /**
     * Base URI of API endpoint
     * @return string
     */
    protected function getBaseURI()
    {
        return 'https://termii.com';
    }

    /**
     *  Send Message
     * @param array $body
     * @return object
     */
    public function sendMessage($body)
    {
        $data = array_merge($this->payload, [
            "from" => $this->senderId,
            "channel" => $this->channel,
            "type" => $this->messageType,
            "to" => $body['phone_number'],
            "sms" => $body['message'],
        ]);

        return $this->post('sms/send', $data);
    }

    /**
     *  Send Token
     * @param array $body
     * @return object
     */
    public function sendToken($body)
    {
        $data = array_merge($this->payload, [
            "message_type" => $this->tokenMessageType,
            "to" => $body['phone_number'],
            "from" => $this->senderId,
            "channel" => $this->channel,
            "pin_attempts" => $this->maxAttempts,
            "pin_time_to_live" => $this->pinTimeToLive,
            "pin_length" => $this->pinLength,
            "pin_placeholder" => $this->pinPlaceholder,
            "message_text" => $body['message'],
            "pin_type" => $this->pinType
        ]);

        return $this->post('sms/otp/send', $data);
    }

    /**
     *  Verify Token
     * @param array $body
     * @return object
     */
    public function verifyToken($body)
    {
        $data = array_merge($this->payload, [
            "pin_id" => $body['pin_id'],
            "pin" => $body['pin']
        ]);

        return $this->post('sms/otp/verify', $data);
    }

    /**
     * Submit post request to Termii
     * @param string $path
     * @param array $body
     * @return object Request response body
     */
    protected function post(string $path, array $body)
    {
        $response = $this->client()->post('/api/' . $path, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $body
        ]);

        $this->response = $response;
        return json_decode($response->getBody(), true);
    }

    /**
     * Get last Response from Termii
     * @return object|null
     */
    public function getResponse()
    {
        return $this->response ?? null;
    }

    /**
     * @param int $attempts
     * @return $this
     */
    public function setMaxAttempts(int $attempts)
    {
        $this->maxAttempts = $attempts;
        return $this;
    }

    /**
     * @param int $minute
     * @return $this
     */
    public function setPinTimeToLive(int $minute)
    {
        $this->pinTimeToLive = $minute;
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function setPinType(string $type)
    {
        $this->pinType = $type;
        return $this;
    }

    /**
     * @param string $channel
     * @return $this
     */
    public function setChannel(string $channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @param string $placeholder
     * @return $this
     */
    public function SetPinPlaceholder(string $placeholder)
    {
        $this->pinPlaceholder = $placeholder;
        return $this;
    }

    /**
     * @param string $messageType
     * @return $this
     */
    public function setMessageType(string $messageType)
    {
        $this->messageType = $messageType;
        return $this;
    }

    /**
     * @param string $tokenMessageType
     * @return $this
     */
    public function setTokenMessageType(string $tokenMessageType)
    {
        $this->tokenMessageType = $tokenMessageType;
        return $this;
    }

    /**
     * @param string $sender
     * @return $this
     */
    public function setSender(string $sender)
    {
        $this->senderId = $sender;
        return $this;
    }
}
