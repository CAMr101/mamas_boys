<?php

function createToken()
{
    $length = 64;

    $str = random_bytes($length);
    $str = base64_encode($str);
    $str = str_replace(["+", "/", "="], "", $str);
    $str = substr($str, 0, $length);
    return $str;

    // return bin2hex(random_bytes(32));
}