<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    
    protected $table = 'queries';
    protected $fillable = [

        'name',
        'server',
        'query',
        'count',
        'last_query'
    ];
}
