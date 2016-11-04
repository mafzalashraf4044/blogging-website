<?php
  session_start();
  if(!isset($_SESSION["login"])){
    $_SESSION["login"] = 0;
  }

  if($_SESSION["login"]){
  include('../admin-header.php');
  include('../../includes/db.php');

  $conn = open_db_conn();
?>

<div class="panel-body collapse-overview">
  <ul class="collapsible popout" data-collapsible="accordion">
    <li>
      <div class="collapsible-header"><i class="material-icons"></i><b>Reservation Requests</b></div>
      <?php
        $sql = "SELECT booking_id  FROM online_table_booking";
        $result = $conn->query($sql);
      ?>
      <div class="collapsible-body"><p><?php echo "$result->num_rows" . " Pending Reservation(s)." ?></p></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons"></i><b>Menu Categories</b></div>
      <?php
      $sql = "SELECT menu_id  FROM menu";
      $result = $conn->query($sql);
      ?>

      <div class="collapsible-body"><p><?php echo "$result->num_rows" . " Menu Category(s)." ?></p></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="material-icons"></i><b>Pending Recipes</b></div>
      <?php
      $sql = "SELECT recipe_id  FROM recipies";
      $result = $conn->query($sql);
      ?>

      <div class="collapsible-body"><p><?php echo "$result->num_rows" . " Pending Recepe(s)." ?></p></div>
    </li>
  </ul>

</div>
<?php

  include('../admin-footer.php');
}

else{
    //$url = "http://" . $_SERVER['HTTP_HOST'];
    $url=  $_SERVER['SCRIPT_NAME'];
    $url = substr(rtrim(dirname($_SERVER['PHP_SELF']), '/\\'), 0, 21);
    $url .= "login";
    header('Location: ' . $url, true, 302);
    die();
}
?>
