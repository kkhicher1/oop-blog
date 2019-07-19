<?php

if (!defined('footer')) {
    exit('You are not authrise to check this page');
}


?>
<!-- Footer -->
<footer id="footer">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-5">
                <div class="footer-widget">
                    <div class="footer-logo">
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
                    <div class="footer-copyright">
                        <span>
                            <?= $site->footer_copyright ?? ''; ?> <a href="/"><?= $site->site_name ?? 'Home'; ?></a>
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-widget">
                            <h3 class="footer-title">About Us</h3>
                            <ul class="footer-links">
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="contact.php">Contacts</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-widget">
                            <h3 class="footer-title">Catagories</h3>
                            <ul class="footer-links">
                                <?php
                                $count = 1;
                                foreach ($db->getCat() as $value) {
                                    ?>
                                    <li><a href="category.php?cat=<?= $value['slug'] ?>"><?= $value['name']; ?></a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="footer-widget">
                    <h3 class="footer-title">Join our Newsletter</h3>
                    <?php
                    if (isset($newsletter_response)) {
                        echo $newsletter_response['error'] ?? $newsletter_response['success'];
                    }

                    ?>
                    <div class="footer-newsletter">
                        <form>
                            <input class="input" type="text" name="newsletter" placeholder="Enter your email">
                            <button class="newsletter-btn" type="submit"><i class="fa fa-paper-plane"></i></button>
                        </form>
                    </div>
                    <ul class="footer-social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>

        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</footer>
<!-- /Footer -->

<!-- jQuery Plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?= html_entity_decode($site->footer_code, ENT_QUOTES) ?? ''; ?>
<script src="js/main.js"></script>

</body>

</html>