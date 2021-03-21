<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convoy extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'truckersmp_event_id',
        'title',
        'banner_url',
        'location',
        'distance',
        'destination',
        'server',
        'meetup_date'
    ];
}
