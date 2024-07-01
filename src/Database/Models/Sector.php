<?php

namespace Ahantu\Locations\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['name', 'district_id'];
}
