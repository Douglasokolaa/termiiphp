<?php

namespace Okolaa\TermiiPHP\Enums;

enum TokenChannel: string
{
    /** This channel sends messages via WhatsApp */
    case WHATSAPP = 'WhatsApp';

    /** This channel is used to send promotional messages and messages to phone number not on dnd */
    case GENERIC = 'generic';

    /** On this channel all your messages deliver whether there is dnd restriction or not on the phone number */
    case DND = 'dnd';

    case EMAIL = 'email';
}
