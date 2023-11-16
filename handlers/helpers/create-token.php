<?php

function createToken()
{
    return random_bytes(32);
}