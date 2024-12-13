<?php

namespace Okolaa\TermiiPHP\Data;

use Okolaa\TermiiPHP\Data\Contracts\ConvertsDtoToRequestArray;

class DeviceTemplate implements ConvertsDtoToRequestArray
{
    public function __construct(
        public readonly string|array $phoneNumber,
        public readonly string       $templateId,
        public readonly array        $data,
        public readonly ?string      $deviceId = null,
    ) {
    }

    public function toRequestArray(): array
    {
        return [
            'phone_number' => $this->phoneNumber,
            'template_id'  => $this->templateId,
            'device_id'    => $this->deviceId,
            'data'         => $this->data,
        ];
    }
}
