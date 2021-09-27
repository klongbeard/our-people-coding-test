<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartedWater extends Model
{
    protected $fillable = ['map', 'islands'];
    protected $hidden = ['created_at', 'updated_at'];
}
