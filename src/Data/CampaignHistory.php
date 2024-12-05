<?php

namespace Okolaa\TermiiPHP\Data;

use Okolaa\TermiiPHP\Data\Contracts\ConvertsArrayToDTO;

class CampaignHistory implements Contracts\ConvertsArrayToDTO
{

    public function __construct(
        public readonly string $id,
        public readonly string $senderId,
        public readonly string $channel,
        public readonly string $receiver,
        public readonly string $message,
        public readonly string $messageAbbreviated,
        public readonly string $amount,
        public readonly string $smsType,
        public readonly string $messageId,
        public readonly string $status,
        public readonly string $createdAt,
        public readonly string $updateAt,
    )
    {
    }

    public static function fromArray(array $data): ConvertsArrayToDTO
    {
        return new self(
            id: $data['id'],
            senderId: $data['sender'],
            channel: $data['channel'],
            receiver: $data['receiver'],
            message: $data['message'],
            messageAbbreviated: $data['message_abbreviation'],
            amount: $data['amount'],
            smsType: $data['sms_type'],
            messageId: $data['message_id'],
            status: $data['status'],
            createdAt: $data['date_created'],
            updateAt: $data['last_updated'],
        );
    }
}