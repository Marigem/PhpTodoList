<?php

namespace app\core;

class Session
{
    public function __construct()
    {
        session_start();
    }
}