<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @package App\Models
 * @mixin \Eloquent
 */
class Question extends Model
{
    use HasFactory;

    public const INLINE = 'inline';

    public const INLINE_MIN_LENGTH = 0;

    public const INLINE_MAX_LENGTH = 200;

    public const MULTILINE = 'multiline';

    public const MULTILINE_MIN_LENGTH = 200;

    public const MULTILINE_MAX_LENGTH = 5000;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type'
    ];

    /**
     * Get the recruitment session the question belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recruitment()
    {
        return $this->belongsTo(Recruitment::class);
    }

    /**
     * Get all the question's answers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
