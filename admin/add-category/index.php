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
  <h2 class="left-margin panel-heading">Add New Category</h2>

  <?php
    $conn = open_db_conn();
    $input_values = array();

    if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["submit"] == "Add"){

      $category = $_POST["category"];
      $sql = "INSERT INTO categories (category) VALUES ('$category')";

      if ($conn->query($sql)) {
        echo "added successfully!";
      }else {
        echo "Error: " . $sql . "<br>" . $conn->error;

      }
      $conn->close();
    }

    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="col s12">

      <div class="row form-area">
        <div class="input-field col s12">
          <input placeholder="" id="category" name="category" required value="" type="text" class="validate">
          <label for="category">Categroy Title</label>
          <i class="hidden fa fa-warning"> <span>Categroy Title is Required!</span></i>
        </div>

        <div class="col s12 button-area">
          <input type="submit" class="waves-effect waves-light btn" name="submit" value="Add">
        </div>

      </div>
    </form>


    <h2 class="left-margin panel-heading">Existing Categories</h2>
    <div class="row form-area">
      <div class="input-field col s12">
        <select name="category">
          <option value="" disabled selected>Existing Categories</option>
      <?php
        $conn = open_db_conn();

        $sql = "SELECT category FROM categories";
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
    </div>

</div>

<?php
  include('../admin-footer.php');
}

else{

    //$url = "http://" . $_SERVER['HTTP_HOST'];
    $url=  $_SERVER['SCRIPT_NAME'];
    $url = substr(rtrim(dirname($_SERVER['PHP_SELF']), '/\\'), 0, 22);
    $url .= "login";
    header('Location: ' . $url, true, 302);
    die();

}
?>
