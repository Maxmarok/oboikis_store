<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum StatusEnum: int
{
    use EnumTrait;
    
    case NEW = 1;
    case REGISTERED = 10;
    case WAITING = 21;
    case PAYED = 70;
    case CLOSED = 200;
    case CANCELED = 220;
}