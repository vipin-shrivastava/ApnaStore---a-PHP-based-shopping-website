<?php
include("../connection/connection.php");



if(!empty($_POST["username"])) {
  $query = "SELECT * FROM task3 WHERE username='" . $_POST["username"] . "'";
  $result = mysqli_query($conn,$query);
  $count = mysqli_num_rows($result);
  if($count>0) {
      echo "<span class='status-not-available'> Username Not Available.</span>";
  }else{
      echo "<span class='status-available'> Username Available.</span>";
  }
}
?>