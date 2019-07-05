<?php

require 'db/DB.php';

class Utility extends DB
{
    public static function is_logged_in()
    {
        if (isset($_SESSION['email'])) {
            return true;
        } else {
            return false;
        }
    }
}
