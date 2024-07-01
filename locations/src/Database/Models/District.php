<?php

namespace Ahantu\Locations\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'province_id'];
}
