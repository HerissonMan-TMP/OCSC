<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    use HasFactory;

    public const CREATED = 'created';

    public const UPDATED = 'updated';

    public const DELETED = 'deleted';

    public const LOGGED_IN = 'logged in';

    public const LOGGED_OUT = 'logged out';

    public const SUBSCRIBED = 'subscribed';

    public const UNSUBSCRIBED = 'unsubscribed';

    public const APPLIED_FOR = 'applied for';

    public const APPLICATION_ACCEPTED = 'application accepted';

    public const APPLICATION_DECLINED = 'application declined';

    public const MARKED_AS_READ = 'marked as read';

    public const MARKED_AS_UNREAD = 'marked as unread';

    public const ENABLED = 'enabled';

    public const DISABLED = 'disabled';

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}