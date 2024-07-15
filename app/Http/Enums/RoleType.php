<?php

namespace App\Http\Enums;

enum RoleType: int
{
    case SUPER_ADMIN = 1;
    case MODERATOR = 2;
    case DOCTOR = 3;
    case USER = 4;
}

