<?php

namespace Ahantu\Locations\Database\Models;

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

    public function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Ahantu\Province::class, 'province_id');
    }

    public function sectors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Ahantu\Sector::class, 'district_id');
    }
}
