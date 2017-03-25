<?php

namespace App\Model\HelloCode;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table = 'Contact';

    protected $fillable = ['status', 'name', 'email', 'note'];

    protected $primaryKey = 'id';




}
