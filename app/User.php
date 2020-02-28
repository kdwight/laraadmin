<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    const ADMIN_ROLE = 1;

    /**
     * The attributes that aren't not mass assignable.
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
        'password', 'remember_token', 'last_login',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'array',
        'status' => 'boolean'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->id();
        });
    }

    /**
     * Get the user's assigned role
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role_id === self::ADMIN_ROLE;
    }

    public function hasAccess()
    {
        return Role::find($this->role_id);
    }

    public function userAgent()
    {
        $agent = new \Jenssegers\Agent\Agent();

        $agent->setUserAgent($this->last_login['user_agent']);

        return $agent;
    }

    public function lastSession()
    {
        return $this->update([
            'last_login' => [
                'at' => \Carbon\Carbon::now()->toDateTimeString(),
                'ip' => request()->getClientIp(),
                'user_agent' => request()->header('User-Agent'),
                'online' => !$this->last_login['online']
            ]
        ]);
    }
}
