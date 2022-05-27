<?php


namespace Sflightning\Lib\Concurrency\Promise;


final class PromiseTools
{

    /**         Properties         **/

    public const UID_SIZE = 32;

    /**         Methods         **/

    public static function generateUid(int $size = self::UID_SIZE): string
    {
        return bin2hex(random_bytes($size));
    }
}