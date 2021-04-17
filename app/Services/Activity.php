<?php

namespace App\Services;

use App\Models\ActivityType;
use App\Models\Activity as ActivityModel;
use App\Models\User;

class Activity
{
    protected $causer;

    protected $type;

    protected $subjectIcon = null;

    protected $subject = null;

    protected $description = null;

    public function __construct(string $type)
    {
        $this->causer = auth()->user();

        $this->type = ActivityType::where('name', $type)->first();
    }

    public function causer(User $user)
    {
        $this->causer = $user;

        return $this;
    }

    public function byAnonymous()
    {
        $this->causer = null;

        return $this;
    }

    public function subject(string $icon, string $subject)
    {
        $this->subjectIcon = $icon;

        $this->subject = $subject;

        return $this;
    }

    public function description(string $description)
    {
        $this->description = $description;

        return $this;
    }

    public function log()
    {
        $activity = new ActivityModel;

        $activity->fill([
            'subject_icon' => $this->subjectIcon,
            'subject' => $this->subject,
            'description' => $this->description,
        ]);

        $activity->type()->associate($this->type);

        if ($this->causer) {
            $activity->causer()->associate($this->causer);
        }

        $activity->save();
    }
}
