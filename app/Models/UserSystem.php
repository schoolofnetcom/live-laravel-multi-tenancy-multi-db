<?php

namespace App\Models;


class UserSystem extends BaseUser
{
    protected $connection = 'system';
    protected $table = 'system_users';
}
