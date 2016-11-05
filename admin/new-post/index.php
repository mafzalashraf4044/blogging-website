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


<div class="panel-body add-categroy">
  <h2 class="left-margin panel-heading">Add New Post</h2>

  <?php
    $conn = open_db_conn();
    $input_values = array();

    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "Submit"){

      foreach ($_POST as $key => $value) {

        if($key != "submit"){
          $input_values += [$key => sanitize_input($value)];
        }
      }

      $keys = implode(', ', array_keys($input_values));
      $values = implode("','", array_values($input_values));

      $sql = "INSERT INTO blog_post ($keys) VALUES ('$values')";

      if ($conn->query($sql)) {
        echo "added successfully!";
      }else {
        echo "Error: " . $sql . "<br>" . $conn->error;

      }
      $conn->close();
    }

    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data" class="col s12">

          </select>
          <i class="hidden fa fa-warning"> <span>Category is Required!</span></i>
        </div>

      <div class="input-field col s12">
            <textarea id="post" name="post" class="materialize-textarea"></textarea>
            <label for="textarea1">Type Here</label>
            <i class="hidden fa fa-warning"> <span>Post is Required!</span></i>
      </div>
      <input type="hidden" name="likes" value="0">
      <input type="hidden" name="comments" value="0">
      <input type="hidden" name="date" value="<?= Date('d-m-Y') ?>">
      <input type="hidden" name="username" value="<?= $_SESSION['username'] ?>">
      <div class="col s12 button-area">
        <input type="submit" class="waves-effect waves-light btn" name="submit" value="Submit">
      </div>

      </div>

    </form>


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
