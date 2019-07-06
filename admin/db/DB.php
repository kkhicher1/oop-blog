<?php

require_once 'inc/functions.php';
class DB
{
    protected $dbh;

    //construct method for setup PDO ...
    public function __construct()
    {
        require_once 'config.php';
        $this->dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
    }
    //checking login username & Password
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
    ///getting user data for show name
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
    public function getAllUserData($table)
    {
        $query = "SELECT id, name, email, username, photo, login, role, slug, created_at FROM " . $table;
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return $result;
        }
        return "No Data Found";
    }
    public function addUser(string $table, array $args, array $file)
    {
        $colName = implode(', ', array_keys($args));
        $placeHolder = ":" . implode(', :', array_keys($args));
        $query = "INSERT INTO $table($colName, photo, slug, created_at) VALUES($placeHolder, :photo, :slug, :created_at)";
        $stmt = $this->dbh->prepare($query);
        foreach ($args as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        $photo = Utility::uploadPhoto($file);
        $slug = strtolower(str_replace(' ', "-", $args['name']));
        $create_at = date('Y-m-d G:i:s');
        $stmt->bindValue(":photo", 'assets/avatar/' . $photo['name']);
        $stmt->bindValue(":slug", $slug);
        $stmt->bindValue(":created_at", $create_at);
        if ($stmt->execute()) {
            if (!move_uploaded_file($photo["tmp_name"], 'assets/avatar/' . $photo['name'])) {
                return "<div class='alert alert-danger'>Photo Unable to Upload</div>";
            };
            return "<div class='alert alert-success'>User Created!</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Create New User</div>";
        }
    }
}
