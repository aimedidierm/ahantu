<?php

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = ['name', 'province_id'];

    protected $casts = [
        'name' => 'string',
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'province_id' => 'required',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function sectors()
    {
        return $this->hasMany(Sector::class, 'district_id');
    }
}
