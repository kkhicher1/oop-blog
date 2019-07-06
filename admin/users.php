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
                <div class="col-2">
                    <a href='add-user.php' class="btn btn-primary btn-block mb-2" type="button">Add New User</a>
                    <a href='user-settings.php' class="btn btn-primary btn-block mb-2" type="button">Profile Settings</a>
                </div>
                <!-- List Of User -->
                <div class="col-12 bg-success">
                    <h1 class="text-center text-white">User List</h1>
                </div>
                <div class="col-12">
                    <table class="table table-light">
                        <tbody>
                            <tr>
                                <th>Avatar</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>User Since</th>
                            </tr>
                            <?php
                            foreach ($db->getAllUserData('users') as $value) {
                                extract($value);
                                echo "<tr>
                                <td><img src='{$photo}' class='img-thumbnail' width='50px'></td>
                                <td>{$username}</td>
                                <td>{$name}</td>
                                <td>{$email}</td>
                                <td>{$created_at}</td>
                            </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
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