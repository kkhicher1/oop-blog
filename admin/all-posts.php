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
                <div class='col-12 bg-success'>
                    <h3 class='text-center text-dark p-3'>All Posts</h3>
                </div>
                <div class='col-10 offset-2'>
                    <table class="table table-light">
                        <tr>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th></th>
                            <th></th>
                        </tr>
                        <?php
                        foreach ($db->findData('posts') as $value) {
                            $cat = $db->getCatName($value['id']);
                            echo "<tr>
                                    <td>{$value['title']}</td>
                                    <td>{$value['status']}</td>
                                    <td>{$cat['name']}</td>
                                    <td>{$value['created_at']}</td>
                                    <td>{$value['updated_at']}</td>
                                    <td><a class='btn btn-warning btn-sm' href='edit-post.php?id={$value['id']}'>Edit</a></td>
                                </tr>";
                        }
                        ?>
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