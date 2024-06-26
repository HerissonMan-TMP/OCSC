<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'banner_url',
        'content',
    ];

    /**
     * Get the user who posted the article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function postedByUser()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
