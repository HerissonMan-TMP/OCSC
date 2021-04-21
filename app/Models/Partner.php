<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'logo',
        'category_id',
        'truckersmp_link',
        'trucksbook_link',
        'website_link',
        'twitter_link',
        'instagram_link',
    ];

    public function category()
    {
        return $this->belongsTo(PartnerCategory::class, 'category_id');
    }
}
