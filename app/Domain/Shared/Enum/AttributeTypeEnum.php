<?php

namespace App\Domain\Shared\Enum;

enum AttributeTypeEnum : string
{
    case TEXT = 'text';
    case TEXTAREA = 'textarea';
    case SELECT = 'select';
    case NUMBER = 'number';
    case CHECKBOX = 'checkbox';
    case RADIO_BUTTON = 'radio';
    case FILE = 'file';
    case PASSWORD = 'password';

    case EMAIL = 'email';
}
