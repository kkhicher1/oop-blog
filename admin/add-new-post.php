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

if (!empty($_POST)){
    if ($_POST['post_action'] == 'publish'){
        $response = $db->storePost($_POST['title'], $_POST['category_id'], $_POST['content'], $_POST['post_action']);
    }else if($_POST['post_action'] == 'draft'){
        $response = $db->storePost($_POST['title'], $_POST['category_id'], $_POST['content'], $_POST['post_action']);
    }
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
                    <h2 class="text-center bg-success text-white mb-4">Add New Post</h2>
                    <?= $response ?? '' ?>
                </div>
                <div class="col-6 offset-3">
                    <form method="post" >
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input id="title" class="form-control" type="text" name="title" placeholder='Enter Title'>
                        </div>
                        <div class="form-group">
                            <label for="category">Categories</label>
                            <select id="category" class="form-control" name="category_id">
                                <?php
                                 if (count($db->getCat())>0){
                                     foreach ($db->getCat() as $item) {
                                         ?>
                                         <option value='<?= $item['id']; ?>'><?= $item['name']; ?></option>
                                         <?php
                                     }
                                 }
                                ?>
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                        </div>
                        <button class="btn btn-success" type="submit" value="draft" name="post_action">Save Draft</button>
                        <button class="btn btn-success" type="submit" value="publish" name="post_action">Publish</button>
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