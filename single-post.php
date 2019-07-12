<?php
include 'front-inc/header.php';

$post = $db->find('posts', 'slug', $_GET['post']);

?>
<!-- Page Header -->
<div id="post-header" class="page-header">
	<div class="background-img" style="background-image: url('./img/post-page.jpg');"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-10">
				<div class="post-meta">
					<a class="post-category cat-2" href="category.html"><?= $db->getCatName($post['id']); ?></a>
					<span class="post-date"><?= $post['created_at']; ?></span>
				</div>
				<h1><?= $post['title']; ?></h1>
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
			<!-- Post content -->
			<div class="col-md-8">
				<div class="section-row sticky-container">
					<div class="main-post">
						<h3><?= $post['title']; ?></h3>
						<!-- ad -->
						<div class="section-row text-center">
							<a href="#" style="display: inline-block;margin: auto;">
								<img class="img-responsive" src="./img/ad-2.jpg" alt="">
							</a>
						</div>
						<!-- ad -->
						<p><?= $post['content']; ?></p>
					</div>
					<div class="post-shares sticky-shares">
						<a href="#" class="share-facebook"><i class="fa fa-facebook"></i></a>
						<a href="#" class="share-twitter"><i class="fa fa-twitter"></i></a>
						<a href="#" class="share-google-plus"><i class="fa fa-google-plus"></i></a>
						<a href="#" class="share-pinterest"><i class="fa fa-pinterest"></i></a>
						<a href="#" class="share-linkedin"><i class="fa fa-linkedin"></i></a>
						<a href="#"><i class="fa fa-envelope"></i></a>
					</div>
				</div>

				<!-- ad -->
				<div class="section-row text-center">
					<a href="#" style="display: inline-block;margin: auto;">
						<img class="img-responsive" src="./img/ad-2.jpg" alt="">
					</a>
				</div>
				<!-- ad -->

				<!-- author -->
				<div class="section-row">
					<div class="post-author">
						<div class="media">
							<div class="media-left">
								<img class="media-object" src="./img/author.png" alt="">
							</div>
							<div class="media-body">
								<div class="media-heading">
									<h3>John Doe</h3>
								</div>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
								<ul class="author-social">
									<li><a href="#"><i class="fa fa-facebook"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- /author -->

				<!-- comment section -->
				<?php include 'front-inc/comment.php' ?>
				<!-- end of comment section -->


				<!-- reply -->
				<?php include 'front-inc/reply.php' ?>
				<!-- /reply -->
			</div>
			<!-- /Post content -->

			<!-- aside -->
			<?php include 'front-inc/sidebar.php' ?>
			<!-- /aside -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<!-- Footer -->
<?php include 'front-inc/footer.php'; ?>