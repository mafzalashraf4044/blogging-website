<?php
include './includes/header.php';
?>

<div class="col-md-8">
  <div class="container" id="all-posts">
    <?php
    $conn = open_db_conn();
    $sql = 'SELECT post_id, title, post, likes, comments, date, username FROM blog_post';
    $result = $conn->query($sql);
    $current_page = $_SERVER['PHP_SELF'];

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()): ?>
          <div class='blog-post'>
              <a href='#post' class='post-title'><h1><?= $row['title'] ?></h1></a>
              <p class='calendar fa fa-calendar'><span> <?= $row['date'] ?></span></p>
              <p class='user fa fa-user'><span> <?= $row['username'] ?></span></p>
              <br>
              <hr>
              <p class='post-content post'><?= $row['post'] ?></p>
              <a href="post.php?post=<?= $row['post_id'] ?>" class='read-more'>Read More</a>

            </div>
            <div class='likes-comments'>
              <i class='likes fa fa-thumbs-up'> <span> <?= $row['likes'] ?> Likes</span></i>
              <i class='comments fa fa-comments'> <span> <?= $row['comments'] ?> Comments</span></i>
          </div>
        <?php
      endwhile;
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>

    <a id="bottom-link" href="">Home</a>
    <p id="subscribe">Subscribe to: <a href="">Learners Spot</a></p>

  </div>

</div>

<?php
include './includes/footer.php';
?>
