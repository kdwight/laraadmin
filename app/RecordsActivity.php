<?php

namespace App;

use Arr;

trait RecordsActivity
{
    /**
     * The project's old attributes.
     *
     * @var array
     */
    public $oldAttributes = [];

    /**
     * Boot the trait.
     */
    public static function bootRecordsActivity()
    {
        if (auth()->guest()) return;

        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

    /**
     * Get the description of the activity.
     *
     * @param  string $description
     * @return string
     */
    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    /**
     * Fetch the model events that should trigger activity.
     *
     * @return array
     */
    protected static function recordableEvents()
    {
        // if model has `protected static $recordableEvents = [];`
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }

        return ['created', 'updated', 'deleted'];
    }

    /**
     * Record activity for a project.
     *
     * @param string $description
     */
    public function recordActivity($description)
    {
        $this->activity()->create([
            'user_id' => auth()->id(),
            'description' => $description,
            'changes' => $this->activityChanges(),
        ]);
    }

    /**
     * The activity feed for the model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

    /**
     * Fetch the changes to the model.
     *
     * @return array|null
     */
    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            if (class_basename($this) == "Role") {
                $this->oldAttributes['modules'] = json_encode($this->oldAttributes['modules']);
            }

            return [
                'before' => Arr::except(array_diff($this->oldAttributes, $this->getAttributes()), ['updated_at', 'password', 'remember_token']),
                'after' => Arr::except($this->getChanges(), ['updated_at', 'password', 'remember_token'])
            ];
        }
    }
}
