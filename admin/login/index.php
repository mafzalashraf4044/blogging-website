<?php
  include('../../includes/db.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login | Adge Dining</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/8a2d7d85ce.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Architects+Daughter" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette" rel="stylesheet">

    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Materialize CSS-->
    <link rel="stylesheet" href="../../materialize/css/materialize.min.css">

    <!-- Custom CSS-->
    <link rel="stylesheet" href="../../css/admin-panel.css">

  </head>
  <body style="padding: 0px;">

    <?php
      $show_error = 0;
      session_start();
      if(!isset($_SESSION["login"])){
        $_SESSION["login"] = 0;
      }
      if($_SERVER["REQUEST_METHOD"]=="POST"){

        $conn = open_db_conn();

        $sql = "SELECT username, password FROM admin_login";

        $result = $conn->query($sql);

        if($result->num_rows > 0){



          if($_SESSION["login"] == 0){
            $show_error = 1;
        }
      }

      }


    ?>

      <div class="login">
        <div class="card login-form">
          <div class="card-content">
            <h3 class="hide-on-small-only">Login to Admin Panel</h3>
            <h5 class="hide-on-med-and-up">Login to Admin Panel</h5>

            <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
              <div class="input-field">
                <input id="username" name="username" required type="text" class="validate">
                <label for="username">Username</label>
                <!-- <i class="hidden fa fa-warning"> <span>Name is Required!</span></i> -->
              </div>

              <div class="input-field">
                <input id="password" name="password" required type="password" class="validate">
                <label for="password">Password</label>
                <!-- <i class="hidden fa fa-warning"> <span>Name is Required!</span></i> -->
              </div>
              <input type="submit" class="waves-effect waves-light btn right" name="submit" value="Submit">

              <span>
              <?php
                if($show_error == 1){
                  echo "Username and/or password was Incorrect!";
                }
              ?>
              </span>
            </form>
          </div>
        </div>

      </div>


          <script src="../../jquery-2.2.3.min.js"></script>
          <script src="../../materialize/js/materialize.min.js"></script>


  </body>
</html>
