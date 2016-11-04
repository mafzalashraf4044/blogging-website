<?php include('../../includes/arrays.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Admin Panel | Learner's Spot</title>
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

<body>
  <div class="main-header">
    <div class="black white-text section row hide-on-med-and-down" id="header">
        <div class="col m6 left">
          Admin Panel Home
        </div>
        <div class="col m6 right">
          <img class="responsive-img circle right" src="../../images/user-icon.png">
          <span class="right">Logged In as: <?php echo $_SESSION["username"] ?></span>
        </div>
    </div>
    <div class="section black white-text hide-on-large-only" id="header-sm-scr">
        <a href="#" data-activates="side-nav" class="button-collapse"><i class="material-icons">menu</i></a>
        <h5><a href="index.php" class="brand-logo logo center">Learner's Spot</a></h5>
    </div>
  </div>

  <!-- Navbar -->
  <ul id="side-nav" class="side-nav fixed">
    <li><div class="userView">
      <img class="background" src="../../images/bg5.jpg">
      <a href="#!"><h5 class="white-text brand-logo">Learner's Spot</h5></a>
      <a href="#!"><h5 class="white-text">Admin Panel</h5></a>
      <a href="#"><span class="white-text">Logged In as: <?php echo $_SESSION["username"] ?></span></a>
    </div></li>

    <li><a href="../add-category/index.php">Add Category</a></li>
    <li><div class="divider"></div></li>
    <li><a href="../new-post/index.php">Add New Post</a></li>
    <li><div class="divider"></div></li>
    <li><a href="../logout.php">Logout</a></li>
  </ul>
