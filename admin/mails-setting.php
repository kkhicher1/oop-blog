<?php
session_start();
session_regenerate_id(true);
define('admin_header', true);
define('db', true);
define('function', true);
require_once 'inc/functions.php';
require_once 'db/DB.php';

$db = new DB();

if (Utility::is_logged_in() == false) {
    header("Location:login.php");
}
if (isset($_GET['logout'])) {
    unset($_SESSION['email']);
    unset($_SESSION['user']);
    header("Location:login.php");
}

extract($db->getUserData('users', $_SESSION['user']), EXTR_PREFIX_ALL, 'user');

if (!empty($_POST)) {
    extract($_POST);
    $post_mail = $post_mail ?? 0;
    $response = $db->mailSetting($host, $port, $username, $password, $tls, $post_mail);
}

$mail = $db->getMailSettings();

?>


<?php include 'inc/header.php' ?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php include 'inc/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include 'inc/top.php'; ?>
            <!-- End of Topbar -->

            <!-- oop box -->
            <div class='oop-box'>
                <div class="col-12 d-flex justify-content-center mb-2">
                    <a href='ads-setting.php' class="btn btn-primary mr-2" type="button">Ads Setting</a>
                    <a href='settings.php' class="btn btn-primary mr-2" type="button">Site Setting</a>
                    <a href='menus-setting.php' class="btn btn-primary mr-2" type="button">Menus Setting</a>
                    <a href='posts-setting.php' class="btn btn-primary mr-2" type="button">Posts Setting</a>
                    <a href='anaytics-setting.php' class="btn btn-primary mr-2" type="button">Site Analytics Setting</a>
                </div>
                <div class="col-12">
                    <h2 class="text-center bg-success text-white mb-4">Mail Setting for Newsletter</h2>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post">
                        <div class="form-group">
                            <label for="host">Host Name</label>
                            <input id="host" class="form-control" type="text" name="host" placeholder='Enter Host Name' value="<?= $mail->host ?>">
                        </div>
                        <div class="form-group">
                            <label for="port">Port</label>
                            <input id="port" class="form-control" type="text" name="port" placeholder='Enter Port' value="<?= $mail->port ?>">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input id="username" class="form-control" type="text" name="username" placeholder='Enter Username' value="<?= $mail->username ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="text" name="password" placeholder='Enter Password' value="<?= $mail->password ?>">
                        </div>
                        <div class="form-group">
                            <label for="tls">TLS</label>
                            <input id="tls" class="form-control" type="text" name="tls" placeholder=' Optional (STARTTLS on all ports)'>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="post_mail" value="1" <?= ($mail->post_mail) ? "checked" : '' ?>> Want to send mail when new post publish
                        </div>
                        <button class="btn btn-success btn-block" type="submit">Save Mail Setting</button>
                    </form>
                </div>
            </div>
            <!-- end of oop box -->

            <!-- Footer -->
            <?php include 'inc/copyright.php'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    <?php include 'inc/footer.php'; ?>