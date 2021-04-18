<?php

namespace App\Models;

use App\Filters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;
    use Filterable;

    public const READ = 'read';

    public const UNREAD = 'unread';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'truckersmp_id',
        'vtc',
        'discord',
        'email',
        'message',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(ContactCategory::class);
    }
}
