<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use RecordsActivity;

    protected $fillable = [
        'name', 'modules', 'description',
    ];

    protected $casts = [
        'modules' => 'array',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::slug($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucwords($value);
    }
}
