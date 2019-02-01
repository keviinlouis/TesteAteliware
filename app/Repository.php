<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    protected $fillable = [
        'full_name',
        'name',
        'owner_name',
        'description',
        'avatar_url',
        'language',
        'stars',
        'query'
    ];
}
