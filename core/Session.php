<?php

namespace app\core;

class Session
{
    const KEYS_USER_ID = 'id';
    const KEYS_JUST_LOGGED_IN = 'logged-in';

    public function __construct()
    {
        session_start();
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function unset($key)
    {
        unset($_SESSION[$key]);
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function is_set($key): bool
    {
        return isset($_SESSION[$key]);
    }
}