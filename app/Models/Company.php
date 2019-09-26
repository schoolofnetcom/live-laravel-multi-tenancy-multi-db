<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use Uuid;
    protected $connection = 'system';
    protected $fillable = ['name', 'connection', 'prefix'];

    public $casts = [
        'id' => 'string'
    ];
}
