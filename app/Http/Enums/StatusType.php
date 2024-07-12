<?php

namespace App\Http\Enums;

enum StatusType: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
