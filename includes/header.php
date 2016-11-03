<?php
  include('./includes/arrays.php');
  //including connection to db from db.php, this file also contains some pre-defined methods for validation etc
  include_once('includes/db.php');

  if(!isset($_SESSION["user_login"])){
      session_start();

      if(count($_SESSION) == 0){
        $_SESSION["user_login"] = 0;
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learner's Spot</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- webiste title icon -->
    <link rel="shortcut icon" type="image/x-icon" href="./images/site-icon.png">

    <!-- font awesome -->
    <script src="https://use.fontawesome.com/8a2d7d85ce.js"></script>

    <!-- custom css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Risque" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">

</head>
<body>

  <!-- Modal For Register Option-->
  <div id="sign-up" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sign Up to Learner's Spot</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST" class="sign-up-form">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" name="usrname" class="form-control" id="username">
            </div>
            <div class="form-group">
              <label for="email">Email address:</label>
              <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" name="pwd" class="form-control" id="password">
            </div>
            <button type="submit" name="signup" class="btn btn-default">Sign Up</button>
          </form>
        </div>
      </div>

    </div>
  </div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])){

  $conn = open_db_conn();
  $input_array = [];
  $show_modal = true;

  foreach($_POST as $key => $value){
      $input_array += [$key => $value];
  }

  $keys = implode("," , array_keys($input_array));
  $values = implode("','", array_values($input_array));

  $sql = "INSERT INTO user_login ($keys) VALUES ('$values')";

  if($conn->query($sql)){
    //echo "Record addedd!";
  }else{
    //echo "error";
  }

  $conn->close();
  }
?>


    <!-- Modal For Sign In Option-->
    <div id="log-in" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <?php if(isset($show_modal)) :?>
              <h4 class="modal-title">Sign Up Successfull, You can now Login to Learner's Spot</h4>
            <?php else: ?>
              <h4 class="modal-title">Log In</h4>
            <?php endif; ?>
          </div>
          <div class="modal-body">
            <form role="form" action="users.php" method="POST" class="sign-up-form">
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="usrname" class="form-control" id="username">
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="pwd" class="form-control" id="password">
              </div>
              <button type="submit" name="login" class="btn btn-default">Log In</button>
          </div>
        </div>

      </div>
    </div>

  <div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
          <div class="side-nav">
            <h1><a href="index.php">Learners Spot</a></h1>
            <nav>
              <ul class="main-menu">
                <li><a href="index.php">HOME</a></li>
                <li><a href="post.php?recent=true">RECENT</a></li>
                <li><a href="post.php?most-viewed=true">MOST VIEWED</a></li>
                <li class="c-dropdown">
                    <a href="#">CATEGORIES</a>
                    <ul class="c-dropdown-menu">
                        <?php
                        $conn = open_db_conn();
                        $sql = 'SELECT category_id, category FROM categories';
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()):
                              $url = 'post.php' . "?category={$row['category_id']}";
                              echo "<li><a href='$url'>{$row['category']}</a></li>";
                            endwhile;
                          } else {
                              echo "0 results";
                          }
                          $conn->close();

                        ?>
                    </ul>
                </li>

                <?php
                  if($_SESSION["user_login"] == 1){
                      echo "<li><a href='users.php'>USER AREA</a></li>";
                      echo "<li><a href='users.php?logout=true'>LOGOUT</a></li>";
                  }

                  if($_SESSION["user_login"] == 0){
                      echo "<li><a href='#sign-up' data-toggle='modal'>SIGNUP</a></li>";
                      echo "<li><a href='#log-in' data-toggle='modal'>SIGNIN</a></li>";
                  }

                ?>
              </ul>
            </nav>

            <div class="side-nav-footer">
                <p>Read about Web Developement, Web Designing, Programming and Other Cool Stuff!!!</p>
                <div class="hidden-xs">
                    <a href="#" id="leftPadding"><i class="fa fa-facebook-square"></i></a>
                    <a href="#"><i class="fa fa-google-plus-square"></i></a>
                    <a href="#"><i class="fa fa-github-square"></i></a>
                    <a href="#"><i class="fa fa-twitter-square"></i></a>
                </div>
            </div>
          </div>
        </div>

        <div class="col-md-9 wrapper">
          <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <p id="intro">Learner's Spot: The Best Place for Knowledge Seekers</p>
                    <div id="search-box" class="form-group">
                        <form action="post.php" method="GET">
                          <input id="search-bar" type="text" name=search class="form-control" placeholder="Search" />
                          <button type="submit"><i id="search-icon" class="glyphicon glyphicon-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
          </div>

          <div class="container main-page">
              <div class="row">
