<?php

namespace App;

/**
 * Class StringHelper
 * @package App
 * @author Sergey Bevzenko <bevzenko.sergey@gmail.com>
 */
class StringHelper
{
    /**
     * @param $base
     * @return string
     */
    public static function recursiveRevert($base)
    {
        return self::doRevert($base);
    }

    private static function doRevert($base, $rev = '')
    {
        if (!$base) {
            return $rev;
        }

        $rev .= mb_substr($base, -1, 1);
        $base = mb_substr($base, 0, -1);

        return self::doRevert($base, $rev);
    }
}