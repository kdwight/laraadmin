<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    const ADMIN_TYPE = 'admin';

    protected $fillable = ['order', 'username', 'password', 'type', 'status', 'created_by', 'updated_by'];
    protected $hidden = ['password', 'remember_token', 'order'];
    protected $dates = ['deleted_at'];

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
