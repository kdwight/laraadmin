<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use LogsActivity;
    const ADMIN_TYPE = 'admin';

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['deleted_at'];

    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

    public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    }

    public function hasAccess()
    {
        $type = $this->type;
        return Role::whereName($type)->first();
    }
}
