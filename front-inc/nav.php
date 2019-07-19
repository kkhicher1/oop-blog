<?php

if (!defined('nav')) {
    exit('You are not authrise to check this page');
}

?>

<!-- Header -->
<header id="header">
    <!-- Nav -->
    <div id="nav">
        <!-- Main Nav -->
        <div id="nav-fixed">
            <div class="container">
                <!-- logo -->
                <div class="nav-logo">
                    <?php
                    if (!empty($site->site_logo)) {
                        ?>
                        <a href="/" class="logo"><img class="img-fluid" src="http://oopblog.test/admin/<?= $site->site_logo; ?>" alt="<?= $site->site_name; ?>" width="75px" height="auto"></a>
                    <?php
                    } else { ?>
                        <h3><a href="/" class="logo"><?= $site->site_name ?? "Demo Site"; ?></a> <small><sub><?= $site->site_subtitle ?? ""; ?></sub></small></h3>
                    <?php }

                    ?>
                </div>
                <!-- /logo -->

                <!-- nav -->
                <ul class="nav-menu nav navbar-nav">
                    <?php
                    foreach ($db->getMenus() as $menu) {
                        ?>
                        <li><a href="<?= $menu->redirect_slug ?>"><?= $menu->name ?></a></li>
                    <?php
                    }
                    ?>
                </ul>
                <!-- /nav -->

                <!-- search & aside toggle -->
                <div class="nav-btns">
                    <button class="aside-btn"><i class="fa fa-bars"></i></button>
                    <button class="search-btn"><i class="fa fa-search"></i></button>
                    <div class="search-form">
                        <input class="search-input" type="text" name="search" placeholder="Enter Your Search ...">
                        <button class="search-close"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <!-- /search & aside toggle -->
            </div>
        </div>
        <!-- /Main Nav -->

        <!-- Aside Nav -->
        <div id="nav-aside">
            <!-- nav -->
            <div class="section-row">
                <ul class="nav-aside-menu">
                    <li><a href="/">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
            <!-- /nav -->
            <!-- social links -->
            <div class="section-row">
                <h3>Follow us</h3>
                <ul class="nav-aside-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                </ul>
            </div>
            <!-- /social links -->

            <!-- aside nav close -->
            <button class="nav-aside-close"><i class="fa fa-times"></i></button>
            <!-- /aside nav close -->
        </div>
        <!-- Aside Nav -->
    </div>
    <!-- /Nav -->
</header>
<!-- /Header -->