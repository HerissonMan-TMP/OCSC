<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function postedByUser()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
