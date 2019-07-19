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
    $response = $db->setAds($_POST['below_header'], $_POST['below_content'], $_POST['sidebar']);
}
$ads = $db->getAds();
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
                    <a href='settings.php' class="btn btn-primary mr-2" type="button">Site Setting</a>
                    <a href='mails-setting.php' class="btn btn-primary mr-2" type="button">Mails Setting</a>
                    <a href='menus-setting.php' class="btn btn-primary mr-2" type="button">Menus Setting</a>
                    <a href='posts-setting.php' class="btn btn-primary mr-2" type="button">Posts Setting</a>
                    <a href='anaytics-setting.php' class="btn btn-primary mr-2" type="button">Site Analytics Setting</a>
                </div>
                <div class="col-12">
                    <h2 class="text-center bg-success text-white mb-4">Ads Section</h2>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="below_header">Below Header Ad</label>
                            <textarea id="below_header" class="form-control" name="below_header" rows="3"><?= $ads[0]->below_header; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="below_content">Below Content Ad</label>
                            <textarea id="below_content" class="form-control" name="below_content" rows="3"><?= $ads[0]->below_content; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sidebar">Sidebar Ad</label>
                            <textarea id="my-sidebar" class="form-control" name="sidebar" rows="3"><?= $ads[0]->sidebar; ?></textarea>
                        </div>
                        <button class="btn btn-success btn-block" type="submit">Save Ad Setting</button>
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