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