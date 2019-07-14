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

$site_setting = $db->getSiteSettings();

if (!empty($_POST)) {
    $response = $db->setSiteSettings($_POST['site_name'], $_POST['site_subtitle'], $_FILES['site_logo'], $_POST['footer_copyright']);
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
                    <a href='posts-setting.php' class="btn btn-primary mr-2" type="button">Posts Setting</a>
                    <a href='anaytics-setting.php' class="btn btn-primary mr-2" type="button">Site Analytics Setting</a>
                </div>
                <div class="col-12">
                    <h2 class="text-center bg-success text-white mb-4">Site Setting</h2>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="site_name">Site Name</label>
                            <input id="site_name" class="form-control" type="text" name="site_name" value="<?= $site_setting->site_name ?? ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="site_subtitle">Site Subtitle</label>
                            <input id="site_subtitle" class="form-control" type="text" name="site_subtitle" value="<?= $site_setting->site_subtitle ?? ''; ?>">
                        </div>
                        <div class="form-group">
                            <label for="customFile">Select Site Logo</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name='site_logo'>
                                <label class="custom-file-label" for="customFile">Choose JPG/PNG file only</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="footer_copyright">Footer Copyright</label>
                            <textarea class="form-control" rows="5" name="footer_copyright"><?= $site_setting->footer_copyright ?? ''; ?></textarea>
                        </div>
                        <button class="btn btn-success btn-block" type="submit">Save Site Settings</button>
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