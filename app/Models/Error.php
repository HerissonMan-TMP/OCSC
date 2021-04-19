<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    use HasFactory;
    use Filterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address',
        'status_code',
        'uri'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
