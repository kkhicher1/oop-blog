<?php
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
				?>
				<!-- post -->
				<div class="col-md-6">
					<div class="post post-thumb">
						<a class="post-img" href="blog-post.html"><img src="./img/post-1.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-meta">
								<a class="post-category cat-2" href="category.html"><?= $db->getCatName($post->id); ?></a>
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
			foreach ($db->getPost(6, 2) as $post) {
				?>
				<!-- post -->
				<div class="col-md-4">
					<div class="post">
						<a class="post-img" href="blog-post.html"><img src="./img/post-3.jpg" alt=""></a>
						<div class="post-body">
							<div class="post-meta">
								<a class="post-category cat-1" href="category.html"><?= $db->getCatName($post->id); ?></a>
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



			<!-- <div class="clearfix visible-md visible-lg"></div> -->

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
					foreach ($db->getPost(4, 8) as $post) {
						?>
						<!-- post -->
						<div class="col-md-12">
							<div class="post post-row">
								<a class="post-img" href="blog-post.html"><img src="./img/post-4.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-2" href="category.html"><?= $db->getCatName($post->id); ?></a>
										<span class="post-date"><?= $post->created_at ?></span>
									</div>
									<h3 class="post-title"><a href="single-post.php?post=<?= $post->slug ?>"><?= $post->title ?></a></h3>
									<p><?= substr($post->content, 0, 150); ?>..... <a class="btn btn-primary btn-sm" href='<?= $post->slug ?>'>Read More</a></p>
								</div>
							</div>
						</div>
						<!-- /post -->
					<?php
					}

					?>

					<div class="col-md-12">
						<div class="section-row">
							<button class="primary-button center-block">Load More</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Side Bar Start -->
			<?php include 'front-inc/sidebar.php' ?>
			<!-- Sidebar End -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- include footer -->
<?php include 'front-inc/footer.php' ?>
<!-- end of include footer -->