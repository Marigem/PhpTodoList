<?php 

namespace app\core;

class User
{
    public $id;
    public $name;
    public $email;

    public function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $id;
        $this->email = $id;
    }
}