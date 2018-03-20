<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'body', 'url', 'author','title'
    ];
    protected $table = 'pz_gs';
}
