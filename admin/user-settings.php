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
extract($db->find('users', 'email', $_SESSION['user']), EXTR_PREFIX_ALL, 'user_setting');

if (!empty($_POST)) {
    $response = $db->updateUser('users', $_POST, $_FILES, $_SESSION['user']);
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
                <div class="col-12 mt-3 bg-success">
                    <h3 class="text-center text-dark p-2">Edit Profile</h3>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" value="<?= $user_setting_name ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" class="form-control" type="email" name="email" value="<?= $user_setting_email ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" class="form-control" type="text" name="password" value="<?= $user_setting_password ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="customFile">Select Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name='photo'>
                                <label class="custom-file-label" for="customFile"><?= $user_setting_photo ?? '' ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select id="role" class="form-control" name="role">
                                <option value='admin' <?= $user_setting_role == 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value='editor' <?= $user_setting_role == 'editor' ? 'selected' : '' ?>>Editor</option>
                                <option value='author' <?= $user_setting_role == 'author' ? 'selected' : '' ?>>Author</option>
                            </select>
                        </div>
                        <button class="btn btn-success btn-block" type="submit">Update Profile</button>
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