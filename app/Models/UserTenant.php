<?php

namespace App\Models;


class UserTenant extends BaseUser
{
    protected $connection = 'tenant';
    protected $table = 'tenant_users';
}
