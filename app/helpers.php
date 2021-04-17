<?php

if (! function_exists('activity')) {

    function activity(string $type)
    {
        return app('activity', [$type]);
    }

}
