<?php

namespace App\Enums;

enum UserRole: string
{
    case Admin = 'admin';
    case User = 'user';
    case Supervisor = 'supervisor';
    case Driver = 'driver';
    case SuperAdmin = 'super_admin';
    case Agent = 'agent';
    case Viewer = 'viewer';
}
