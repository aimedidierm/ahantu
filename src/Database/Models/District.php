<?php

namespace Ahantu\Locations\Database\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'province_id'];
}
