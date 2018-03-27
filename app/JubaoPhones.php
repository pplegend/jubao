<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JubaoPhones extends Model
{
    protected $table = 'jubao_phones';
    protected $fillable = ['title','description'];
}
