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
    $response = $db->addMenu($_POST['name'], $_POST['redirect_slug']);
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
                    <a href='settings.php' class="btn btn-primary mr-2" type="button">Site Setting</a>
                    <a href='posts-setting.php' class="btn btn-primary mr-2" type="button">Posts Setting</a>
                    <a href='anaytics-setting.php' class="btn btn-primary mr-2" type="button">Site Analytics Setting</a>
                </div>
                <div class="col-12">
                    <h2 class="text-center bg-success text-white mb-4">Add New Menu</h2>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input id="name" class="form-control" type="text" name="name" placeholder='Enter Name'>
                        </div>
                        <div class="form-group">
                            <label for="redirect_slug">Redirect Slug</label>
                            <input id="redirect_slug" class="form-control" type="text" name="redirect_slug" placeholder='Enter Redirect Slug'>
                        </div>
                        <button class="btn btn-success btn-block" type="submit">Save New Menu</button>
                    </form>
                </div>
                <div class="col-8 offset-3 mt-2">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Redirected To</th>
                            </tr>
                            <?php
                            foreach ($db->getMenus() as $menu) {
                                echo "<tr>
                                        <td>{$menu->name}</td>
                                        <td>{$menu->redirect_slug}</td>
                                        <td><a href='edit.php?from=menus&id={$menu->id}' class='btn btn-warning btn-sm'>Edit</a>
                                        <a href='delete.php?from=menus&id={$menu->id}' class='btn btn-danger btn-sm'>Delete</a></td>
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