<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "learners-spot";

// Create Connection
function open_db_conn(){
  global $servername;
  global $username;
  global $password;
  global $dbname;

  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  return $conn;
}

function validate_input($key, $input_value){

    if(empty($input_value)){
      return "$key is Required!";
    }
    return NULL;

}

function sanitize_input($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}

?>
