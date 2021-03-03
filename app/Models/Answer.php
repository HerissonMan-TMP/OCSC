<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Answer
 *
 * @package App\Models
 * @mixin \Eloquent
 */
class Answer extends Model
{
    use HasFactory;

    /**
     * Get the application the answer belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    /**
     * Get the question the answer belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(Answer::class);
    }
}
