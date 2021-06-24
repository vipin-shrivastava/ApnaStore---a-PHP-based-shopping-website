<?php

session_start();
include("../connection/connection.php");

if ($_REQUEST["Submit"] == "Reset") {

    $email = $_REQUEST['email'];

    $sql = "SELECT id from task3 WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
        foreach ($result as $row) {
            $id = $row['id'];
        }

        $random = rand(1000, 9000);

        $query = "UPDATE task3 SET code = '$random' WHERE id = '$id'";

        $res = mysqli_query($conn, $query);

        $cou = mysqli_affected_rows($conn);

        if ($cou == 1) {
            $_SESSION['id'] = $id;
            $_SESSION['code'] = $random;
            $_SESSION['email'] = $email;
            header("Location: forgetPasswordEmail.php");
        }else{
         echo "yaha pr";
        }
    } else {
?>
      <script>
            alert("Email not Matched ! Please Check .");
            setTimeout(function() {
                    window.location.replace("../");
                }, 0);
        </script>
<?php
        // header("Location: forgetpasswordusername.php");
    }
}else{
    echo "////";
}


?>