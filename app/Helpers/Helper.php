<?php
namespace App\Helpers;

class Helper
{
    public static function colorRand()
    {
        return '#' . dechex(rand(0x000000, 0xFFFFFF));
    }
}

