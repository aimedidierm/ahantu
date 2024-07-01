<?php

namespace Ahantu\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];
}

class District extends Model
{
    protected $fillable = ['name', 'province_id'];
}

class Sector extends Model
{
    protected $fillable = ['name', 'district_id'];
}

class Cell extends Model
{
    protected $fillable = ['name', 'sector_id'];
}

class Village extends Model
{
    protected $fillable = ['name', 'cell_id'];
}
