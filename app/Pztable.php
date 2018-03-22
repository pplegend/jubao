<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pztable extends Model
{
    protected $fillable = [
        'body', 'title','url','author','count','status','type','visitor'
    ];
    protected $table = 'pz_table';
}
