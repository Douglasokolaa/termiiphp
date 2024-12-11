<?php

namespace Okolaa\TermiiPHP\Data\Contracts;

interface ConvertsDtoToRequestArray
{
    /**
     * @return array<string, int|string|null|array>
     */
    public function toRequestArray(): array;
}