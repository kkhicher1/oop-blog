<div class="col-md-4">
    <!-- ad -->
    <div class="aside-widget text-center">
        <a href="#" style="display: inline-block;margin: auto;">
            <img class="img-responsive" src="./img/ad-1.jpg" alt="">
        </a>
    </div>
    <!-- /ad -->

    <!-- catagories -->
    <div class="aside-widget">
        <div class="section-title">
            <h2>Catagories</h2>
        </div>
        <div class="category-widget">
            <ul>
                <?php
                $count = 1;
                foreach ($db->getCat() as $value) {
                    if ($count % 2 == 0) {
                        ?>
                        <li><a href="category.php?cat=<?= $value['slug']; ?>" class="cat-1"><?= $value['name']; ?><span><?= count($db->getPostByCat($value['id'])) ?></span></a></li>
                    <?php
                    } else if ($count % 3 == 0) {
                        ?>
                        <li><a href="category.php?cat=<?= $value['slug']; ?>" class="cat-2"><?= $value['name']; ?><span><?= count($db->getPostByCat($value['id'])) ?></span></a></li>
                    <?php
                    } else if ($count % 5 == 0) {
                        ?>
                        <li><a href="category.php?cat=<?= $value['slug']; ?>" class="cat-3"><?= $value['name']; ?><span><?= count($db->getPostByCat($value['id'])) ?></span></a></li>
                    <?php
                    } else {
                        ?>
                        <li><a href="category.php?cat=<?= $value['slug']; ?>" class="cat-4"><?= $value['name']; ?><span><?= count($db->getPostByCat($value['id'])) ?></span></a></li>
                    <?php
                    }
                    ?>

                    <?php
                    $count++;
                }



                ?>
            </ul>
        </div>
    </div>
    <!-- /catagories -->

    <!-- tags -->
    <div class="aside-widget">
        <div class="tags-widget">
            <ul>
                <?php
                foreach ($db->getTags() as $tag) {
                    ?>
                    <li><a href="<?= $tag->slug; ?>"><?= $tag->name; ?></a></li>
                <?php
                }



                ?>
            </ul>
        </div>
    </div>
    <!-- /tags -->
</div>