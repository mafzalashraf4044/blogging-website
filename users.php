<?php
session_start();

if(isset($_GET["logout"])){
  $_SESSION["user_login"] = 0;
  unset($_SESSION['username']);
}

include_once('includes/db.php');

if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['login'])){
  $conn = open_db_conn();
  $usrname = $_POST['usrname'];
  $pwd = $_POST['pwd'];

  $sql = "SELECT user_id, usrname, pwd FROM user_login WHERE usrname='$usrname' AND pwd='$pwd'";

  $result = $conn->query($sql);
  if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();

    $_SESSION["user_login"] = 1;
    $_SESSION['username'] = $row['usrname'];
    $_SESSION['user_id'] = $row['user_id'];
  }

  $conn->close();
}

include './includes/header.php';
?>

<!-- Database logic for User Post Submission -->
<?php
  $conn = open_db_conn();
  $input_values = array();

  if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post'])){

    foreach ($_POST as $key => $value) {
      if($key != "submit"){
        $input_values += [$key => sanitize_input($value)];
      }
    }

    $keys = implode(', ', array_keys($input_values));
    $values = implode("','", array_values($input_values));

    $sql = "INSERT INTO pending_users_posts ($keys) VALUES ('$values')";

    if ($conn->query($sql)) {
      echo "added successfully!";
    }else {
      echo "Error: " . $sql . "<br>" . $conn->error;

    }
    $conn->close();
  }

  ?>

<div class="col-md-8">
  <div class="container" id="users">

  <?php
    if($_SESSION["user_login"] == 1):
  ?>
    <?php
      $conn = open_db_conn();
      $user_id = $_SESSION['user_id'];

      $sql = "SELECT title, post, likes, comments, date, username FROM pending_users_posts WHERE user_id=$user_id";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<h1>Pending Posts</h1>";
        while($row = $result->fetch_assoc()): ?>

            <div class='blog-post'>
                <a href='#' class='post-title'><h1><?= $row['title'] ?></h1></a>
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
      }else {
//      echo "<h5>There are no Pending Posts</h5>";
      }
      $conn->close();

      ?>


      <?php
        $conn = open_db_conn();
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT title, post, likes, comments, date, username FROM blog_post WHERE user_id=$user_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo "<h1>Approved Posts</h1>";
          while($row = $result->fetch_assoc()): ?>

              <div class='blog-post'>
                  <a href='#' class='post-title'><h1><?= $row['title'] ?></h1></a>
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
        }else {
//        echo "<h5>There are no Pending Posts</h5>";
        }
        $conn->close();

        ?>


    <h1>Submit Your Post</h1>
    <form></form>
    <form role="form" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
      <div class="form-group">
        <label for="title">Title:</label>
        <input type="title" name="title" class="form-control" id="title">
      </div>
      <div class="form-group">
        <label for="category">Category:</label>
        <select name="category" class="form-control">
          <option value="" disabled selected>Select Category</option>
      <?php
        $conn = open_db_conn();

        $sql = "SELECT category_id, category FROM categories";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

        while($row = $result->fetch_assoc()) {
          echo "<option value='" .$row['category_id']. "'>" .$row['category']. "</option>";
        }

         }else {
          echo "<h5>There are no Categories Avaliable</h5>";
         }
        $conn->close();

        ?>
        </select>
      </div>
      <div class="checkbox">
        <label><input type="checkbox"> I agree to the terms and conditions of Learner's Spot.</label>
      </div>
      <textarea id="editor" name="post" required rows="18" cols="40"></textarea>

      <input type="hidden" name="likes" value="0">
      <input type="hidden" name="comments" value="0">
      <input type="hidden" name="date" value="<?= Date('d-m-Y') ?>">
      <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
      <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
      <button type="submit" class="btn btn-default">Submit</button>
    </form>



  <?php else: ?>
    <h1>Please Login First</h1>
  <?php endif; ?>

  </div>
</div>

<?php
include './includes/footer.php';
?>
