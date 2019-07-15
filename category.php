<?php
include 'front-inc/header.php';

$cat = $db->find('categories', 'slug', $_GET['cat']);

?>
<!-- Page Header -->
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<ul class="page-header-breadcrumb">
					<li><a href="/">Home</a></li>
					<li><?= $cat['name']; ?></li>
				</ul>
				<h1><?= $cat['name']; ?></h1>
			</div>
		</div>
	</div>
</div>
<!-- /Page Header -->
</header>
<!-- /Header -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<?php
					foreach ($db->getPostByCat($cat['id'], 10) as $post) {
						?>
						<!-- post -->
						<div class="col-md-12">
							<div class="post post-row">
								<a class="post-img" href="blog-post.html"><img src="./img/post-2.jpg" alt=""></a>
								<div class="post-body">
									<div class="post-meta">
										<a class="post-category cat-2" href="#"><?= $cat['name']; ?></a>
										<span class="post-date"><?= $post->created_at; ?></span>
									</div>
									<h3 class="post-title"><a href="blog-post.html"><?= $post->title; ?></a></h3>
									<p><?= substr($post->content, 0, 150); ?>..... <a class="btn btn-primary btn-sm" href='single-post.php?post=<?= $post->slug ?>'>Read More</a></p>
								</div>
							</div>
						</div>
						<!-- /post -->
					<?php
					}
					?>
					<!-- ad -->
					<?= $below_content ?>
					<!-- ad -->

					<div class="col-md-12">
						<div class="section-row">
							<button class="primary-button center-block">Load More</button>
						</div>
					</div>
				</div>
			</div>

			<!-- sidebar -->
			<?php include 'front-inc/sidebar.php'; ?>
			<!-- end sidebar -->
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- Footer -->
	<?php include 'front-inc/footer.php'; ?>