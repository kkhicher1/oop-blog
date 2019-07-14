<?php
session_start();
session_regenerate_id(true);
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
    $response = $db->setAnalyticsSettings($_POST['header_code'], $_POST['footer_code']);
}
$site_setting = $db->getSiteSettings();

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
                    <a href='posts-setting.php' class="btn btn-primary mr-2" type="button">Posts Setting</a>
                    <a href='settings.php' class="btn btn-primary mr-2" type="button">Site Setting</a>
                </div>
                <div class="col-12">
                    <h2 class="text-center bg-success text-white mb-4">Analytics Setting</h2>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="header_code">Header Script Code</label>
                            <textarea class="form-control" rows="5" name="header_code"><?= html_entity_decode($site_setting->header_code) ?? ''; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="footer_code">Footer Script Code</label>
                            <textarea class="form-control" rows="5" name="footer_code"><?= html_entity_decode($site_setting->footer_code) ?? ''; ?></textarea>
                        </div>

                        <button class="btn btn-success btn-block" type="submit">Save Analytics Settings</button>
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