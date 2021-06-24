<?php

include("../connection/connection.php");
session_start();

$code = $_REQUEST['vcode'];
$id = $_SESSION["user_id"];
$v = 1;

$query = "UPDATE task3 SET validate = '$v' WHERE id='$id' AND valid_code='$code' ";

$result = mysqli_query($conn, $query);

$count = mysqli_affected_rows($conn);


if ($count == 1) {

    $sql = "SELECT * FROM task3 WHERE id = '$id'";



    $res = mysqli_query($conn, $sql);



    $cou = mysqli_num_rows($res);

    echo $cou;

    if ($cou == 1) {

        foreach ($res as $row) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["login_user"] = $row["username"];
        }


        $_SESSION["logging"] = 1;

        header("location:../panel.php");
    } else {
        ?>


    <script>
       alert("Something went wrong . Try Again !!!");

        setTimeout(function() {
            window.location.replace("../validateCode.php");
        }, 1000);
    </script>

<?php
    }
} else {

?>


    <script>
       alert("you may have a valid account . login  !!");

        setTimeout(function() {
            window.location.replace("../");
        }, 1000);
    </script>

<?php


}

?>