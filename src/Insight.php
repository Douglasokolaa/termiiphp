<?php

namespace Okolaa\TermiiPHP;

class Insight extends Termii
{

    /**
     * Termii Insight constructor.
     */
    public function __construct($senderId = 'N-Alert', $apiKey = '')
    {
        parent::__construct($senderId, $apiKey);
    }

    /**
     * returns reports for messages sent across the sms,
     * voice & whatsapp channels. Reports can either
     * all messages on termii or a single message. http://developer.termii.com/docs/inbox/
     *
     * @return array
     */
    public function getSenderIds()
    {
        return $this->get('sms/inbox', $this->payload());
    }

    /**
     * returns your total balance and balance information from your wallet,
     * such as currency. http://developer.termii.com/docs/balance/
     *
     * @return array
     */
    public function getBallance()
    {
        return $this->get('get-balance', $this->payload());
    }

    /**
     * verify phone numbers and automatically detect their
     * status as well as current network. It also tells ifthe number
     * has activated the do-not-disturb settings. http://developer.termii.com/docs/search/
     *
     * @param string $phone_number Phone number to search for
     * @return array
     */
    public function search($phone_number)
    {
        $payload = array_merge(
            $this->payload(),
            [
                'phone_number' => $phone_number
            ]
        );

        return $this->get('check/dnd', $payload);
    }
}