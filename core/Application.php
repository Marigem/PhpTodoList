<?php 

namespace app\core;

class Application
{
    public static Application $app;
    public Authenticator $auth;
    public Session $session;

    public function __construct($auth, $session)
    {
        self::$app = $this;
        $this->auth = $auth;
        $this->session = $session;
    }
}