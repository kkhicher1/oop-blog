<?php
if (!defined('db')) {
    exit();
}
define('config', true);
define('phpmailer', true);
define('smtp', true);
define('exception', true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';

// require_once 'inc/functions.php';
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
    public function find(string $table, $col, $value)
    {
        $query = "SELECT * FROM " . $table . " WHERE $col='$value'";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            foreach ($result as $value) {
                return $value;
            }
        }
        return "No Data Found";
    }


    public function updateUser(string $table, array $args, array $file, $email)
    {
        $photo = Utility::uploadPhoto($file);
        if (empty($photo['name'])) {
            $photo['name'] = "https://nulm.gov.in/images/user.png";
        } else {
            $photo['name'] = 'assets/avatar/' . $photo['name'];
        }
        $query = "UPDATE $table SET name= '" . $args['name'] . "',email='" . $args['email'] . "',password='" . $args['password'] . "',photo='" . $photo['name'] . "',role='" . $args['role'] . "' WHERE email='$email'";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            if (empty($photo['name'])) {
                if (!move_uploaded_file($photo["tmp_name"], 'assets/avatar/' . $photo['name'])) {
                    return "<div class='alert alert-danger'>Photo Unable to Upload</div>";
                };
            }
            return "<div class='alert alert-success'>Profile Updated!</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Update Profile </div>";
        }
    }
    public function findData(string $table)
    {
        $query = "SELECT * FROM $table";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) > 0) {
            return $result;
        }
        return "No Data Found";
    }
    public function addCat($name)
    {
        $query = "INSERT INTO categories(name, slug) VALUES(:name, :slug)";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(":name", $name);
        $slug = strtolower(str_replace(' ', "-", $name));
        $stmt->bindValue(":slug", $slug);
        if ($stmt->execute()) {
            return "<div class='alert alert-success'>Category Added</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Add Category</div>";
        }
    }
    public function getCatName($postid)
    {
        $q = "SELECT categories.name,categories.slug FROM posts INNER JOIN categories ON posts.category_id=categories.id WHERE posts.id=" . $postid;
        $stmt = $this->dbh->prepare($q);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $cat_name) {
            $category = ['name' => $cat_name['name'], 'slug' => $cat_name['slug']];
            return $category;
        }
        return false;
    }
    public function getCat()
    {
        $q = "SELECT * FROM categories";
        $stmt = $this->dbh->prepare($q);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function storePost($title, $cat_id, $content, String $status)
    {
        $query = "INSERT INTO posts(title, slug, content, status, category_id) VALUES(:title, :slug, :content, :status, :category_id)";
        $slug = strtolower(str_replace(' ', "-", $title));
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':slug', $slug);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':category_id', $cat_id);
        if ($stmt->execute()) {
            if ($status == 'publish') {
                $settings = $this->getMailSettings();
                if ($settings->post_mail) {
                    $emails = $this->newsLetterMails();
                    foreach ($emails as $email) {
                        $result = $this->sendMail($email->email, substr($content, 0, 75) . "..... <a class='btn btn-primary btn-sm' href='http://oopblog.test/single-post.php?post=$slug'>Read More</a>");
                    }
                } else {
                    $result = '';
                }
            } else {
                $result = '';
            }
            return "<div class='alert alert-success'>Post Stored " . $result . "</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Store Post</div>";
        }
    }
    public function addTag($name)
    {
        $query = "INSERT INTO tags(name, slug) VALUES(:name, :slug)";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(":name", $name);
        $slug = strtolower(str_replace(' ', "-", $name));
        $stmt->bindValue(":slug", $slug);
        if ($stmt->execute()) {
            return "<div class='alert alert-success'>Tag Added</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Add Tag</div>";
        }
    }

    public function getTags()
    {
        $q = "SELECT * FROM tags";
        $stmt = $this->dbh->prepare($q);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getPost($limit = null, $offset = null)
    {
        if ($limit == null) {
            $query = "SELECT * FROM posts WHERE status='publish' ORDER BY created_at DESC, id DESC";
        } else {
            if ($offset == null) {
                $query = "SELECT * FROM posts WHERE status='publish' ORDER BY created_at DESC, id DESC LIMIT $limit";
            } else {
                $query = "SELECT * FROM posts WHERE status='publish' ORDER BY created_at DESC, id DESC LIMIT " . $offset . ", " . $limit;
            }
        }
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }
    public function getPostByCat($id, $limit = '')
    {
        $q = "SELECT posts.* FROM categories INNER JOIN posts ON categories.id=posts.category_id WHERE category_id=" . $id;
        $stmt = $this->dbh->prepare($q);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }
    public function getSiteSettings()
    {
        $q = "SELECT * FROM settings";
        $stmt = $this->dbh->prepare($q);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($results as $result) {
            return $result;
        }
    }
    public function setSiteSettings($site_name = '', $site_subtitle = '', $site_logo = '', $footer_copyright = '')
    {

        if (is_array($site_logo)) {
            $site_logo = Utility::uploadPhoto($site_logo);
            if (!empty($site_logo['name'])) {
                $logo = 'assets/site-logo/' . $site_logo['name'];
            } else {
                $logo = '';
            }
        } else {
            $logo = '';;
        }
        $query = "UPDATE settings SET site_name='$site_name', site_subtitle='$site_subtitle', site_logo='$logo', footer_copyright='$footer_copyright' WHERE id=1";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            if (!empty($logo)) {
                if (!move_uploaded_file($site_logo["tmp_name"], $logo)) {
                    return "<div class='alert alert-danger'>Site Logo Unable to Upload</div>";
                };
            }
            return "<div class='alert alert-success'>Site Setting Saved</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Save Site Settings</div>";
        }
    }
    public function newsletter($email)
    {
        if (strpos($email, '@') == FALSE) {
            return ['error' => "<div class='alert alert-danger'>Provide Valid Email</div>"];
        }
        $query = "INSERT INTO newsletter(email) VALUES(:email)";
        $stmt = $this->dbh->prepare($query);
        $stmt->bindValue(":email", $email);
        if ($stmt->execute()) {
            return ['success' => "<div class='alert alert-success'>Subscription Success</div>"];
        }
    }
    public function setAnalyticsSettings($header_code = '', $footer_code = '')
    {
        $query = "UPDATE settings SET header_code='" . htmlentities($header_code, ENT_QUOTES) . "', footer_code='" . htmlentities($footer_code, ENT_QUOTES) . "' WHERE id=1";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            return "<div class='alert alert-success'>Analytics Setting Saved</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Save Analytics Settings </div>";
        }
    }
    public function addMenu($name, $redirect_slug)
    {
        $query = "INSERT INTO menus(name, redirect_slug) VALUES('$name', '$redirect_slug')";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            return "<div class='alert alert-success'>New Menu Saved</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Save Menu</div>";
        }
    }
    public function getMenus()
    {
        $query = "SELECT * FROM menus";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (count($result) > 0) {
            return $result;
        }
        return [];
    }


    //delete data
    public function delete(string $table, int $id)
    {
        $query = "DELETE FROM $table WHERE id=" . $id . " LIMIT 1";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        } else {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
    public function updateMenu($id, $name, $redirect_slug)
    {
        $query = "UPDATE menus SET name='$name', redirect_slug='$redirect_slug' WHERE id=" . $id;
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            header('Location:menus-setting.php');
        } else {
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }
    //ads setting add and update data

    public function setAds($below_header = null, $below_content = null, $sidebar = null)
    {
        $query = "UPDATE ads SET below_header='" . htmlentities($below_header, ENT_QUOTES) . "', below_content='" . htmlentities($below_content, ENT_QUOTES) . "', sidebar='" . htmlentities($sidebar, ENT_QUOTES) . "' WHERE id=1";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            return "<div class='alert alert-success'>New Ads Setting Saved</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Save Ads Setting</div>";
        }
    }
    public function getAds()
    {
        $query = "SELECT * FROM ads";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (count($result) > 0) {
            return $result;
        }
        return [];
    }

    //mail settings
    public function mailSetting($host, $port, $username, $password, $tls, $post_mail)
    {
        $query = "UPDATE mailsetting SET host= '$host' , port= '$port', username = '$username', password='$password', tls='$tls', post_mail = '$post_mail' WHERE id=1";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            return "<div class='alert alert-success'>New Mail Setting Saved</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Save Mail Setting</div>";
        }
    }
    public function getMailSettings()
    {
        $query = "SELECT * FROM mailsetting";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (count($results) > 0) {
            foreach ($results as $result) {
                return $result;
            }
        }
        return [];
    }
    public function sendMail($email, $content)
    {
        $settings = $this->getMailSettings();
        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0;
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = $settings->host; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $settings->username; // SMTP username
        $mail->Password = $settings->password; // SMTP password
        $mail->SMTPSecure = $settings->tls ?? 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $settings->port; // TCP port to connect to

        //Recipients
        $mail->setFrom('oopblogtest@mail.com', 'Newsletter');
        $mail->addAddress($email, 'Oop Blog Viewer'); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'New Post Published';
        $mail->Body = $content;

        if ($settings->post_mail) {
            if ($mail->send()) {
                return "Mail Sent";
            } else {
                return "Unable to send mail";
            }
        }
    }
    public function newsLetterMails()
    {
        $query = "SELECT * FROM newsletter";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (count($results) > 0) {
            return $results;
        }
        return [];
    }




    //post settings

    public function getPostSettings()
    {
        $q = "SELECT * FROM postsettings";
        $stmt = $this->dbh->prepare($q);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        foreach ($results as $result) {
            return $result;
        }
    }
    public function setPostSettings($post_length = 0, $no_of_posts = 0, $sidebar_active = 0)
    {
        $query = "UPDATE postsettings SET post_content_length='" . $post_length . "', no_of_posts='" . $no_of_posts . "', sidebar_active='" . $sidebar_active . "' WHERE id=1";
        $stmt = $this->dbh->prepare($query);
        if ($stmt->execute()) {
            return "<div class='alert alert-success'>New Post Setting Saved</div>";
        } else {
            return "<div class='alert alert-danger'>Unable to Save Post Setting</div>";
        }
    }
}
