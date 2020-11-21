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
     * Termii constructor.
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
        return 'https://termii.com/';
    }

    /**
     * Request Payload
     * @return array
     */
    protected function payload()
    {
        return ["api_key" => $this->apiKey];
    }

    /**
     * Submit post request to Termii
     * @param string $path
     * @param array $payload
     * @return array Request response payload
     */
    protected function post(string $path, array $payload)
    {
        $response = $this->client()->post('api/' . $path, [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => $payload,
            'verify' => $this->verifySSL
        ]);

        $this->response = $response;
        return json_decode($response->getBody(), true);
    }


    /**
     * Submit get request to Termii API
     * @param string $path
     * @param array $payload
     * @return array Request response payload
     */
    protected function get(string $path, array $payload)
    {
        $response = $this->client()->get('api/' . $path, [
            'headers'   => ['Content-Type' => 'application/json'],
            'query'     => $payload,
            'verify'    => $this->verifySSL
        ]);

        $this->response = $response;
        return json_decode($response->getBody(), true);
    }

    /**
     * send text messages to their customers. The API accepts 
     * form-encoded request bodies, returns JSON-encoded responses, 
     * and uses standard HTTP response codes. 
     * more info: http://developer.termii.com/docs/messaging/
     * 
     * @param array $payload
     * @return array
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
     *  trigger one-time-passwords (pins) across any available
     *  messaging channel on Termii. Passwords created are generated
     *  randomly and there's an option to set an expiry time. 
     *  more info: http://developer.termii.com/docs/send-token/
     * 
     * @param array $payload
     * @return array
     */
    public function sendToken($payload)
    {
        $data = array_merge($this->payload(), [
            "message_type" => $this->tokenMessageType,
            "to" => $payload['phone_number'],
            "from" => $this->senderId,
            "channel" => $this->channel,
            "pin_attempts" => $this->maxAttempts,
            "pin_time_to_live" => $this->pinTimeToLive,
            "pin_length" => $this->pinLength,
            "pin_placeholder" => $this->pinPlaceholder,
            "message_text" => $payload['message'],
            "pin_type" => $this->pinType
        ]);

        return $this->post('sms/otp/send', $data);
    }

    /**
     * checks tokens sent to customers and returns a response 
     * confirming the status of the token. A token can either be 
     * confirmed as verified or expired based on the timer set for
     * the token. http://developer.termii.com/docs/verify-token/
     * 
     * @param array $payload
     * @return array
     */
    public function verifyToken($payload)
    {
        $data = array_merge($this->payload(), [
            "pin_id" => $payload['pin_id'],
            "pin" => $payload['pin']
        ]);

        return $this->post('sms/otp/verify', $data);
    }

    /**
     * Tokens are numeric or alpha-numeric codes generated 
     * to authenticate login requests and verify customer 
     * transactions. http://developer.termii.com/docs/in-app-token/
     * 
     * @param array $payload
     * @return array
     */
    public function InAppToken($payload)
    {
        $data = array_merge($this->payload(), [
            "pin_type" => $this->pinType,
            "phone_number" => $payload['phone_number'],
            "pin_attempts" => $this->maxAttempts,
            "pin_time_to_live" => $this->pinTimeToLive,
            "pin_length" => $this->pinLength
        ]);

        return $this->post('sms/otp/generate', $data);
    }

    /**
     * send messages to customers using Termii's 
     * auto-generated messaging numbers that adapt to customers location.
     * http://developer.termii.com/docs/number/
     * 
     * @param array $payload
     * @return array
     */
    public function sendWithAutoGeneratedNumber($payload)
    {
        $data = array_merge($this->payload(), [
            "to" => $payload['phone_number'],
            "sms" => $payload['message']
        ]);

        return $this->post('sms/number/send', $data);
    }


    /**
     * retrieve the status of all registered sender ID 
     * and request registration of sender ID through 
     * GET request type. http://developer.termii.com/docs/senderid/
     * 
     * @param array $payload
     * @return array
     */
    public function getSenderIds()
    {
        return $this->get('sender-id', $this->payload());
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
     * Sets Max Attempts
     * 
     * @param int $attempts
     * @return $this
     */
    public function setMaxAttempts(int $attempts)
    {
        $this->maxAttempts = $attempts;
        return $this;
    }

    /**
     * Sets Pin Time To Live
     * 
     * @param int $minute
     * @return $this
     */
    public function setPinTimeToLive(int $minute)
    {
        $this->pinTimeToLive = $minute;
        return $this;
    }

    /**
     * Sets Pin Type
     * 
     * @param string $type
     * @return $this
     */
    public function setPinType(string $type)
    {
        $this->pinType = $type;
        return $this;
    }

    /**
     * Sets Channel to Send Messag Via
     * 
     * @param string $channel
     * @return $this
     */
    public function setChannel(string $channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Sets Pin Placeholder
     * 
     * @param string $placeholder
     * @return $this
     */
    public function SetPinPlaceholder(string $placeholder)
    {
        $this->pinPlaceholder = $placeholder;
        return $this;
    }

    /**
     * Sets Message Type
     * 
     * @param string $messageType
     * @return $this
     */
    public function setMessageType(string $messageType)
    {
        $this->messageType = $messageType;
        return $this;
    }

    /**
     * Sets Token Message Type
     * 
     * @param string $tokenMessageType
     * @return $this
     */
    public function setTokenMessageType(string $tokenMessageType)
    {
        $this->tokenMessageType = $tokenMessageType;
        return $this;
    }

    /**
     * Sets Pin Length
     * @param int $pinLength
     * @return $this
     */
    public function SetPinLength($pinLength)
    {
        $this->pinLength = $pinLength;
        return $this;
    }

    /**
     * Sets Sender Id
     * 
     * @param string $sender
     * @return $this
     */
    public function setSender(string $sender)
    {
        $this->senderId = $sender;
        return $this;
    }

    /**
     * Sets API Key
     * 
     * @param string $key
     * @return $this
     */
    public function setAPIKey(string $key)
    {
        $this->apiKey = $key;
        return $this;
    }
}
