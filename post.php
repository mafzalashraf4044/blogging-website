<?php
include './includes/header.php';
?>

<div class="col-md-8">
  <div class="container" id="post">
    <!-- Show Full Post, read more -->
    <?php
    if(isset($_GET["post"])){
    $conn = open_db_conn();
    $post_id = $_GET['post'];
    $sql = "SELECT title, post, likes, comments, date, username FROM blog_post WHERE post_id=$post_id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()): ?>
          <div class='blog-post'>
              <a href='#post' class='post-title'><h1><?= $row['title'] ?></h1></a>
              <p class='calendar fa fa-calendar'><span> <?= $row['date'] ?></span></p>
              <p class='user fa fa-user'><span> <?= $row['username'] ?></span></p>
              <br>
              <hr>
              <p class='post-content'><?= $row['post'] ?></p>
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
    unset($_GET['post']);
    }
    ?>

<?php
include './includes/footer.php';
?>
