<?php

namespace App\Services;

/**
 * Class TemporaryPasswordService
 *
 * Generate a short and random password containing only lowercase letters and numbers.
 *
 * @package App\Services
 */
class TemporaryPasswordService
{
    /**
     * Characters the password can contain.
     *
     * @var string
     */
    protected static $setOfCharacters = 'abcdefghijklmnopqrstuvwxyz0123456789';

    /**
     * Length of the password.
     *
     * @var int
     */
    protected static $length = 8;

    /**
     * Generate the password.
     *
     * @return false|string
     */
    public static function generate()
    {
        return substr(str_shuffle(self::$setOfCharacters), 0, self::$length);
    }
}
