<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Application
 *
 * @package App\Models
 * @mixin \Eloquent
 */
class Application extends Model
{
    use HasFactory;
    use Filterable;

    public const NEW = 'new';

    public const DECLINED = 'declined';

    public const ACCEPTED = 'accepted';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'truckersmp_id',
        'discord',
        'email',
        'steam_profile',
        'trucksbook_profile',
        'age',
        'pc_configuration',
        'status',
    ];

    /**
     * Get the application's answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Get the recruitment session the application belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }

    /**
     * Scope a query to only include applications with the status 'New'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Get the answer for the application's question.
     *
     * @param Question $question
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function answerForQuestion(Question $question)
    {
        return $this->answers()->where('question_id', $question->id)->first();
    }
}
