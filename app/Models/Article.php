<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

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

    public function postedByUser()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
