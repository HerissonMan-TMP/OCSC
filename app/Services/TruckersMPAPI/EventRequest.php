<?php

namespace App\Services\TruckersMPAPI;

use App\Services\TruckersMPAPI\Request;

class EventRequest extends Request
{
    public function events()
    {
        $this->endpoint = 'events';

        return $this;
    }

    public function event(int $id)
    {
        $this->endpoint = 'events/' . $id;

        return $this;
    }
}
