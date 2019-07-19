<?php
define('header', true);
include 'front-inc/header.php';

?>
<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<?php
			foreach ($db->getPost(2) as $post) {
				$cat = $db->getCatName($post->id);
				?>
				<!-- post -->
				<div class="col-md-6">
					<div class="post post-thumb">
						<a class="post-img" href="single-post.php?post=<?= $post->slug ?>"><img src="./img/post-1.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-meta">
								<a class="post-category cat-2" href="category.php?cat=<?= $cat['name']; ?>"><?= $cat['name']; ?></a>
								<span class="post-date"><?= $post->created_at; ?></span>
							</div>
							<h3 class="post-title"><a href="single-post.php?post=<?= $post->slug ?>"><?= $post->title ?></a></h3>
						</div>
					</div>
				</div>
				<!-- /post -->
			<?php
			}
			?>
		</div>
		<!-- /row -->

		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Recent Posts</h2>
				</div>
			</div>

			<?php
			$count = 1;
			foreach ($db->getPost(6, 2) as $post) {
				$cat = $db->getCatName($post->id);
				if ($count == 3) {
					?>
					<!-- post -->
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="single-post.php?post=<?= $post->slug ?>"><img src="./img/post-3.jpg" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-1" href="category.php?cat=<?= $cat['slug']; ?>"><?= $cat['name']; ?></a>
									<span class="post-date"><?= $post->created_at; ?></span>
								</div>
								<h3 class="post-title"><a href="single-post.php?post=<?= $post->slug ?>"><?= $post->title ?></a></h3>
							</div>
						</div>
					</div>
					<div class="clearfix visible-md visible-lg"></div>
					<!-- /post -->
				<?php
				} else { ?>
					<div class="col-md-4">
						<div class="post">
							<a class="post-img" href="single-post.php?post=<?= $post->slug ?>"><img src="./img/post-3.jpg" alt=""></a>
							<div class="post-body">
								<div class="post-meta">
									<a class="post-category cat-1" href="category.php?cat=<?= $cat['slug']; ?>"><?= $cat['name']; ?></a>
									<span class="post-date"><?= $post->created_at; ?></span>
								</div>
								<h3 class="post-title"><a href="single-post.php?post=<?= $post->slug ?>"><?= $post->title ?></a></h3>
							</div>
						</div>
					</div>
				<?php }
				$count++;
			}
			?>




		</div>
		<!-- /row -->


	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<div class="col-md-12">
						<div class="section-title">
							<h2>Most Read</h2>
						</div>
					</div>
					<?php
					foreach ($db->getPost($record_per_page, $start_from) as $post) {
						$cat = $db->getCatName($post->id);
						?>
						<!-- post -->
						<div class="col-md-12">
							<div class="post post-row">
								<a class="post-img" href="blog-post.html"><img src="./img/post-4.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-2" href="category.php?cat=<?= $cat['slug']; ?>"><?= $cat['name']; ?></a>
										<span class="post-date"><?= $post->created_at ?></span>
									</div>
									<h3 class="post-title"><a href="single-post.php?post=<?= $post->slug ?>"><?= $post->title ?></a></h3>
									<p><?= substr($post->content, 0, $post_setting->post_content_length); ?>..... <a class="btn btn-primary btn-sm" href='<?= $post->slug ?>'>Read More</a></p>
								</div>
							</div>
						</div>
						<!-- /post -->
					<?php
					}
					if ($page > 1) {
						echo "<a class='primary-button' href='index.php'>First</a>\t\t\t";
						echo "<a class='primary-button' href='index.php?page=" . ($page - 1) . "'><<</a>\t\t\t";
					}
					for ($i = $page; $i < $total_pages; $i++) {
						echo "<a class='primary-button' href='index.php?page=" . $i . "'>" . $i . "</a>\t\t\t";
					}
					if ($total_pages < $page) {
						echo "<a class='primary-button' href='index.php?page=" . ($page + 1) . "'>>></a>\t\t\t";
						echo "<a class='primary-button' href='index.php?page=" . $total_pages . "'>Last</a>\t\t\t</ul>";
					}
					?>
				</div>
			</div>

			<!-- Side Bar Start -->
			<?php
			if ($post_setting->sidebar_active) {
				define('sidebar', true);
				include 'front-inc/sidebar.php';
			}
			?>
			<!-- Sidebar End -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- include footer -->

<?php
define('footer', true);
include 'front-inc/footer.php'
?>
<!-- end of include footer -->