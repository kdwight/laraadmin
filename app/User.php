<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use RecordsActivity;
    use Notifiable;

    const ADMIN_ROLE = 1;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean'
    ];

    protected static $ignoredAttributes = [
        'updated_at', 'password', 'remember_token'
    ];

    /**
     * Get the user's assigned role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role_id == self::ADMIN_ROLE;
    }

    public function path()
    {
        return "/admin/users/{$this->id}";
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
