<?php

namespace Ahantu\Locations\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Cell extends Model
{
    protected $fillable = ['name', 'sector_id'];
}
