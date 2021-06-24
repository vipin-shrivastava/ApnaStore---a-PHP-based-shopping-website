<?php

include("../connection/connection.php");
session_start();

$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['password'];
$vcode = rand(1000, 9999);


$query = "INSERT INTO task3(username,email,passcode,valid_code) VALUES ('$username','$email','$pass','$vcode')";
$result = mysqli_query($conn, $query);
$count = mysqli_affected_rows($conn);

if ($conn == 1) {
    $que = "SELECT id from task3 WHERE email='$email'";
    $result = mysqli_query($conn, $que);
    $cou = mysqli_num_rows($result);
    if($cou == 1){
        foreach($result as $row){
            $_SESSION['user_id'] = $row['id'];
        }
        $_SESSION['user_email'] = $email;
        $_SESSION['validation_code'] = $vcode;
        header("location:sendVarificationCode.php");
    }
    
}
