<?php

class DB
{
    protected $dbh;

    //construct method for setup PDO ...
    public function __construct()
    {
        require_once 'config.php';
        $this->dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }
    public function login(string $table, $email, $password)
    {
        $query = "SELECT * FROM " . $table . " WHERE email='" . $email . "' AND password='" . $password . "'";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $value) {
            if ($value['email'] == $email && $value['password'] == $password) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    public function getUserData($table, $user)
    {
        $query = "SELECT id, name, username, photo, login, role, slug, created_at FROM " . $table . " WHERE email='" . $user . "'";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $value) {
            return $value;
        }
        return false;
    }
}
