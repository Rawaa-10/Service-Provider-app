<?php 

namespace App\Enums;

enum RoleUserEnum : string {
    case Admin = 'admin';
    case Client = 'client';
    case Provider = 'provider';
}