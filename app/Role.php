<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity;

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected static $logUnguarded = true;
}
