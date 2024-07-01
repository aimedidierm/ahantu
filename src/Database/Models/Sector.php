<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $fillable = ['name', 'district_id'];

    protected $casts = [
        'name' => 'string',
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'district_id' => 'required',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    public function cells()
    {
        return $this->hasMany(Cell::class, 'sector_id');
    }
}
