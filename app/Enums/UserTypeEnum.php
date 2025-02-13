<?php

namespace App\Enums;

enum UserTypeEnum: string
{
    case READER = 'reader';
    case USER = 'user';
    case ADMIN = 'admin';
}


