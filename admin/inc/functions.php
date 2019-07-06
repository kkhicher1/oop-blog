<?php

require_once 'db/DB.php';

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
    public static function uploadPhoto(array $file)
    {
        foreach ($file as $value) {

            if ($value['size'] < 1588352) {
                if ($value['type'] == "image/jpeg" || $value['type'] == "image/png") {
                    return $value;
                }
            } else {
                return false;
            }
        }
    }
}
