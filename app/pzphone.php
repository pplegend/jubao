<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pzphone extends Model
{
    protected $fillable = [
        'body', 'url', 'author','phone'
    ];
    protected $table = 'pz_shouji';
}
