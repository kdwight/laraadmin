<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use LogsActivity;

    protected static $logUnguarded = true;
    protected static $logOnlyDirty = true;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * Boot the model.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug =  Str::slug($model->title);
            $model->created_by = auth()->id();
        });

        static::updating(function ($model) {
            $model->slug =  Str::slug($model->title);
            $model->updated_by = auth()->id();
        });
    }

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Access the details attribute without xss tags.
     *
     * @param  string $details
     * @return string
     */
    public function getDescriptionAttribute($description)
    {
        return \Purify::clean($description);
    }
}
