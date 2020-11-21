<?php

namespace Okolaa\TermiiPHP;

use GuzzleHttp\Client;

/**
 * Termii SMS APi Library for PHP
 * @author Douglas Okolaa
 */
class Termii
{
    protected $apiKey;
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
    public $verifySSL = true;

    /**
     * Termii SMS constructor.
     */
    public function __construct($senderId = 'N-Alert', $apiKey = '')
    {
        $this->senderId = $senderId;
        $this->apiKey   = $apiKey;
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
     * Request Payload
     */
    protected function payload()
    {
        return ["api_key" => $this->apiKey];
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
            'json' => $body,
            'verify' => $this->verifySSL
        ]);

        $this->response = $response;
        return json_decode($response->getBody(), true);
    }

    /**
     *  Send Message
     * @param array $body
     * @return object
     */
    public function sendMessage($payload)
    {
        $data = array_merge($this->payload(), [
            "from" => $this->senderId,
            "channel" => $this->channel,
            "type" => $this->messageType,
            "to" => $payload['phone_number'],
            "sms" => $payload['message'],
        ]);

        return $this->post('sms/send', $data,);
    }

    /**
     *  Send Token
     * @param array $body
     * @return object
     */
    public function sendToken($body)
    {
        $data = array_merge($this->payload(), [
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
        $data = array_merge($this->payload(), [
            "pin_id" => $body['pin_id'],
            "pin" => $body['pin']
        ]);

        return $this->post('sms/otp/verify', $data);
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

    /**
     * Set API Key
     * @param string $key
     * @return $this
     */
    public function setAPIKey(string $key)
    {
        $this->apiKey = $key;
        return $this;
    }
}
