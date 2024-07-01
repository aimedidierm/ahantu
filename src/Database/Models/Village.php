<?php

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    protected $fillable = ['name', 'cell_id'];

    protected $casts = [
        'name' => 'string',
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'sector_id' => 'required',
    ];

    public function cell()
    {
        return $this->belongsTo(Cell::class, 'cell_id');
    }
}
