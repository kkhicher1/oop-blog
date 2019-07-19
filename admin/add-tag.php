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
//
if (!empty($_POST)) {
    $response = $db->addTag($_POST['name']);
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
                <div class="col-12">
                    <h2 class="text-center bg-success text-white mb-4">Add New Tag</h2>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder='Enter Tag Name'>
                        </div>
                        <button class="btn btn-success btn-block" type="submit">Add New Tag</button>
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