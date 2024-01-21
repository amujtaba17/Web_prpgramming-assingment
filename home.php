<?php
require_once 'utilities/blogposts.php';
require_once 'utilities/user.php';

if (!is_user_loggedin()) {
	header("Location: index.php");
	return;
}

$blogposts = get_all_posts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="style.css">
	<title>Home</title>
</head>

<body>

	<?php include "header.php"; ?>
	<?php if (isset($_SESSION["flash_message"])) : ?>
		<div class="success-message"><?= $_SESSION["flash_message"]; ?></div>
	<?php unset($_SESSION["flash_message"]);
	endif;
	?>
	<div style="text-align: center" class="WBH">
		<h1>YOUR BLOGS</h1>
		<div class="blog-wrapper">
			<?php
			if ($blogposts != null) :
				foreach ($blogposts as $blogpost) :
					$author = $blogpost["user_full_name"];
					$post_id = $blogpost["post_id"];
					$post_title = $blogpost["post_title"];
					$post_body = $blogpost["post_body"];
					$likes = $blogpost["likes"];
					$reads = $blogpost["_reads"];
					$post_date = $blogpost["post_date"]; // String object
					$post_date = date_create($post_date); // DateTime object
					$post_date = date_format($post_date, "jS, F, Y.");
			?>
					<section class="blogpost">
						<div class="blogtitle"><?= $post_title ?> <p class="blogauthor">By <?= $author ?></p>
						</div>
						<div style="color: #dff1f1;"><?= $post_body ?>. <a style="color: white; text-decoration: underline; font-size: 12px;" href="post.php?id=<?= $post_id ?>">read more...</a></div>
						<div class="blogpostfooter">
							<!-- Note: Never expose database ids in urls -->
							<?php if ($likes > 0) : ?>
								<a href="postlikes.php?id=<?= $post_id ?>">
								<?php endif; ?>
								<span class="blogdate"><small><i class="count"><?= $likes ?></i> Likes</small></span>
								<span class="blogdate"><small><i class="count"><?= $likes ?></i> Followers</small></span>

								<?php if ($likes > 0) : ?>
								</a>
							<?php endif; ?>

							<?php if ($reads > 0) : ?>
								<a href="postreads.php?id=<?= $post_id ?>">
								<?php endif; ?>
								<span class="blogdate"><small><i class="count"><?= $reads ?></i> Views</small></span>
								<span class="blogdate"><small><i class="count"><?= $likes ?></i> Shares</small></span>
								<?php if ($reads > 0) : ?>
								</a>
							<?php endif; ?>

							<div class="blogdate"><small>Posted on: <?= $post_date ?></small></div>
						</div>
					</section>
			<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</body>

</html>

<style>
	/* CSS code */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.WBH {
  height: 100%;
  margin: 0;
  padding: 20px;
  text-align: center;
  background: linear-gradient(to bottom, #2c3e50, #1c2833);
  color: #ecf0f1;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.blog-wrapper {
  margin-top: 20px;
}

.blogpost {
  margin-bottom: 20px;
  padding: 15px;
  background-color: rgba(44, 62, 80, 0.9);
  border-radius: 8px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
  text-align: left;
}

.blogtitle {
  font-size: 24px;
  margin-bottom: 10px;
  color: #ecf0f1;
}

.blogauthor {
  font-size: 14px;
  color: #bdc3c7;
}

.blogpostfooter {
  margin-top: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.blogdate {
  font-size: 12px;
  color: #bdc3c7;
}

.count {
  font-weight: bold;
  color: #E1F0DA;
}

a {
  color: #F3B95F;
  text-decoration: none;
}

a:hover {
  text-decoration: underline;
  color: #2980b9;
}

</style>

