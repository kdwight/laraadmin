<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['visitors_count', 'banner_path'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'visitors' => 'array',
        'seo' => 'array',
    ];

    /**
     * Boot the model.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
        });

        static::created(function ($model) {
            $model->update(['slug' => $model->title]);
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

    // mutators / setters

    /**
     * Set the proper slug attribute.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        if (static::where('id', '!=', $this->id)->whereSlug($slug = Str::slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }

        $this->attributes['slug'] = $slug;
    }

    // accessors / getters

    /**
     * Determine the article's unique visitors count.
     *
     * @return boolean
     */
    public function getVisitorsCountAttribute($value)
    {
        return ($this->visitors) ? count($this->visitors) : 0;
    }

    /**
     * Get a string path for the banner image.
     *
     * @return string
     */
    public function getBannerPathAttribute()
    {
        return "/storage/pages/{$this->banner}";
    }
}
