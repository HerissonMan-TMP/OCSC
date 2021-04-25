<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_icon',
        'subject',
        'description',
    ];

    /**
     * Get the user who caused the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function causer()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the type of the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(ActivityType::class);
    }
}
