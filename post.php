<?php
session_start();
require_once 'utilities/blogposts.php';

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    $blogpost = get_blogpost_by_id($post_id);
    $user_id = isset($_SESSION["_user"]) ? $_SESSION["_user"]["user_id"] : null;

    if ($user_id) {
        $alreadyRead = already_read($user_id, $post_id);

        if (!$alreadyRead) {
            mark_as_read($user_id, $post_id);
        }
    }

    if ($blogpost) {
        $author = $blogpost["user_full_name"];
        $post_title = $blogpost["post_title"];
        $post_body = $blogpost["post_body"];
        $likes = $blogpost["likes"];
        $reads = !$alreadyRead ? $blogpost["_reads"] + 1 : $blogpost["_reads"];
        $post_date = $blogpost["post_date"];
        $post_date = date_create($post_date);
        $post_date = date_format($post_date, "jS, F, Y.");
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8" />
            <link rel="stylesheet" href="style.css">
            <title><?= $post_title ?></title>
        </head>

        <body>
            <?php include "header.php"; ?>

            <div class="post-section">
                <div class="title-wrapper">
                    <h1><?= $post_title ?></h1>
                    <p class="">By <?= $author ?></p>
                </div>
                <div><?= $post_body ?></div>
                <div class="blogpostfooter">
                    <div class="post-like">
                        <?php if (!already_liked($_SESSION['_user']['user_id'], $post_id)) : ?>
                            <form method="POST" action="likepost.php">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <button type="submit">Like</button>
                                <form method="POST" action="">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <button type="submit" disabled>Followed</button>
                            </form>
                            <form method="POST" action="">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <button type="submit" disabled>Shared</button>
                            </form>
                            </form>
                        <?php else : ?>
                            <form method="POST" action="likepost.php">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <button type="submit" disabled>Liked</button>
                            </form>
                            <form method="POST" action="">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <button type="submit" disabled>Followed</button>
                            </form>
                            <form method="POST" action="">
                                <input type="hidden" name="post_id" value="<?= $post_id ?>">
                                <button type="submit" disabled>Shared</button>
                            </form>
                        <?php endif; ?>
                        <?php if ($likes > 0) : ?>
                            <a href="postlikes.php?id=<?= $post_id ?>">
                            <?php endif; ?>
                            <span class=""><small><i class="count blogdate"><?= $likes ?></i> Likes</small></span>
                            <span class=""><small><i class="count blogdate"><?= $likes ?></i> Shares</small></span>
                            <?php if ($likes > 0) : ?>
                            </a>
                        <?php endif; ?>
                    </div>
                    <?php if ($reads > 0) : ?>
                        <a href="postreads.php?id=<?= $post_id ?>">
                        <?php endif; ?>
                        <span class=""><small><i class="count blogdate"><?= $reads ?></i> Views</small></span>
                        <span class=""><small><i class="count blogdate"><?= $likes ?></i> Followers</small></span>
                        <?php if ($reads > 0) : ?>
                        </a>
                    <?php endif; ?>
                    <div class=""><small>Posted on: <?= $post_date ?></small></div>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        header("Location: home.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}
?>



<style>
    /* CSS code */
.post-section {
  height: 100%;
  margin: 0;
  padding: 150px;
  text-align: center;
  background: linear-gradient(to bottom, #2c3e50, #1c2833);
  color: #ecf0f1;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.post-wrapper {
  margin-top: 20px;
}

.post-content {
  margin-bottom: 20px;
  padding: 15px;
  background-color: rgba(44, 62, 80, 0.9);
  border-radius: 8px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
  text-align: left;
}

.post-title {
  font-size: 24px;
  margin-bottom: 10px;
  color: #ecf0f1;
}

.post-author {
  font-size: 14px;
  color: #bdc3c7;
}

.post-footer {
  margin-top: 10px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.post-date {
  font-size: 12px;
  color: #bdc3c7;
}

.post-count {
  font-weight: bold;
  color: #3498db;
}

.post-link {
  color: #3498db;
  text-decoration: none;
}

.post-link:hover {
  text-decoration: underline;
  color: #2980b9;
}

</style>