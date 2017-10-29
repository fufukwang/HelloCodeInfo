<?php

namespace App\Model\Lotto;

use Illuminate\Database\Eloquent\Model;

class LPower extends Model
{
    //
    protected $table = 'lpower';

    protected $fillable = ['day', 'tr_day', 'num1', 'num2', 'num3', 'num4', 'num5', 'num6', 'num_sp'];

    protected $primaryKey = 'id';




}
