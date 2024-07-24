<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    //

    protected $table = 'rsname';
    protected $fillable = ['nama_rs','nama_server'];
}
