<?php 

namespace app\core;

class InputValidator
{
    public static function post_data($field)
    {
        if (!isset($_POST[$field]))
            return false;

        return htmlspecialchars(stripslashes($_POST[$field]));
    }
}


?>