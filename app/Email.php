<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'body', 'url', 'author','title'
    ];
    protected $table = 'pz_email';
}
