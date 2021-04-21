<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'opening_at'
    ];

    protected $dates = [
        'opening_at',
    ];

    public function partners()
    {
        return $this->hasMany(Partner::class, 'category_id');
    }
}
