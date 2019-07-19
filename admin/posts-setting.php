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

$post_setting = $db->getPostSettings();

if (!empty($_POST)) {
    $sidebar_active = $_POST['sidebar_active'] ?? 0;
    $response = $db->setPostSettings($_POST['post_length'], $_POST['no_of_posts'], $sidebar_active);
}

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
                    <a href='mails-setting.php' class="btn btn-primary mr-2" type="button">Mails Setting</a>
                    <a href='menus-setting.php' class="btn btn-primary mr-2" type="button">Menus Setting</a>
                    <a href='settings.php' class="btn btn-primary mr-2" type="button">Site Setting</a>
                    <a href='anaytics-setting.php' class="btn btn-primary mr-2" type="button">Site Analytics Setting</a>
                </div>
                <div class="col-12">
                    <h2 class="text-center bg-success text-white mb-4">HomePage Post Setting</h2>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post">
                        <div class="form-group">
                            <label for="post_length">Post Length</label>
                            <input id="post_length" class="form-control" type="text" name="post_length" placeholder='Post Length (Default is 150 Char.)' value="<?= $post_setting->post_content_length ?>">
                        </div>
                        <div class="form-group">
                            <label for="no_of_posts">No of Posts</label>
                            <input id="no_of_posts" class="form-control" type="text" name="no_of_posts" placeholder='Enter No of Post (Default is 10 Posts)' value="<?= $post_setting->no_of_posts ?>">
                        </div>
                        <div class="form-group">
                            <label for="sidebar_active">Sidebar Active</label>
                            <input type="checkbox" name="sidebar_active" value="1" <?= ($post_setting->sidebar_active) ? 'checked' : '' ?>> Want to active Sidebar
                        </div>
                        <button class="btn btn-success btn-block" type="submit">Save Posts Setting</button>
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