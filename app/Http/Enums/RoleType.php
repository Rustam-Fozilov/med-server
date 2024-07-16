<?php

namespace App\Http\Enums;

enum RoleType: string
{
    case SUPER_ADMIN = 'super_admin';
    case MODERATOR = 'moderator';
    case DOCTOR = 'doctor';
    case USER = 'user';
}

