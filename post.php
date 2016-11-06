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

    <!-- Show Post By Category -->
    <?php
    if(isset($_GET["category"])){
    $conn = open_db_conn();
    $category = $_GET['category'];
    $sql = "SELECT post_id, title, post, likes, comments, date, username FROM blog_post WHERE category=$category ORDER BY post_id DESC";

    display_posts($sql, $conn);

    $conn->close();
    unset($_GET['category']);
    }
    ?>

    <!-- Most Viewed Post -->
    <?php
    if(isset($_GET["most-viewed"])){
    $conn = open_db_conn();

    $sql = "SELECT post_id, title, post, likes, comments, date, username FROM blog_post WHERE likes > 5 ORDER BY likes DESC LIMIT 5";

    display_posts($sql, $conn);

    $conn->close();
    unset($_GET['most-viewd']);
    }
    ?>


    <!-- Recent Posts -->
    <?php
    if(isset($_GET["recent"])){
    $conn = open_db_conn();

    $sql = "SELECT post_id, title, post, likes, comments, date, username FROM blog_post ORDER BY post_id DESC LIMIT 5";

    display_posts($sql, $conn);
    $conn->close();
    unset($_GET['recent']);
    }
    ?>

    <!-- Search Results -->
    <?php
    if(isset($_GET["search"])){
    $conn = open_db_conn();
    $search = $_GET['search'];
    $sql = "SELECT post_id, title, post, likes, comments, date, username FROM blog_post WHERE title LIKE '%$search%'";


    display_posts($sql, $conn);
    $conn->close();
    unset($_GET['search']);
    }
    ?>

    <!-- Filter by Date/ Blog Archive -->
    <?php
    if(isset($_GET["date"])){
    $conn = open_db_conn();
    $date = (int)$_GET["date"];

    var_dump($date);


    $sql = "SELECT post_id, title, post, likes, comments, date, username FROM blog_post WHERE date=$date";


    display_posts($sql, $conn);
    $conn->close();
    unset($_GET['date']);
    }
    ?>


    <!-- Display Post Template -->
    <?php
      function display_posts($sql, $conn){
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
      }
    ?>
  </div>
</div>
<?php
include './includes/footer.php';
?>
