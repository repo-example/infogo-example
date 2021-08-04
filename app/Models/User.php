<?php

namespace App\Models;

class User extends BaseModel
{
    protected $fillable = [
        'username',
        'password',
        'name',
        'api_token'
    ];
}
