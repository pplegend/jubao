<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class qq extends Model
{
    protected $fillable = [
        'body', 'url', 'author','title'
    ];
    protected $table = 'pz_qq';
}
