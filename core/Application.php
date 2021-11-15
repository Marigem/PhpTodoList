<?php 

namespace app\core;

class Application
{
    public static Application $app;
    public Authenticator $auth;
    public Session $session;
    public ItemCreator $creator;
    public ItemFetcher $fetcher;
    public ItemFactory $factory;
    public ShareUnshare $sharing;

    public function __construct(Authenticator $auth, Session $session, ItemCreator $creator, ItemFetcher $fetcher, ItemFactory $factory, ShareUnshare $sharing)
    {
        self::$app = $this;
        $this->auth = $auth;
        $this->session = $session;
        $this->creator = $creator;
        $this->fetcher = $fetcher;
        $this->factory = $factory;
        $this->sharing = $sharing;

        if (Application::$app->session->is_set(Session::KEYS_USER_ID))
        {
            $id = Application::$app->session->get(Session::KEYS_USER_ID);
            $user = $this->auth->getUserById($id);
            $this->auth->user = $user;
        }
        else
        {
            $this->auth->user = null;
        }
    }
}