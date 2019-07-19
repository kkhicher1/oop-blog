<?php

if (!defined('function')) {
    exit();
}

class Utility
{
    public static function is_logged_in()
    {
        if (isset($_SESSION['email'])) {
            return true;
        } else {
            return false;
        }
    }
    public static function uploadPhoto(array $file)
    {
        if ($file['size'] < 1588352) {
            if ($file['type'] == "image/jpeg" || $file['type'] == "image/png") {
                return $file;
            }
        } else {
            return false;
        }
    }
    public static function checkDirectAccess($name)
    {
        if (!defined($name)) {
            exit('You are not authrise to access this page');
        }
    }
}
