<?php
session_start();

include("../connection/connection.php");

if ($_SESSION["login_user"] != null) {

    if ($_SESSION['logging'] == 1) {
        $oldPassword = $_REQUEST['oldpassword'];
        $newPassword = $_REQUEST['newpassword'];
        $cnfpassword = $_REQUEST['cnfpassword'];
        $uid = $_SESSION["user_id"];

        //   echo "old password : " . $oldPassword . "<br> New Password : " . $newPassword . "<br> confirm Password : " . $cnfpassword;
        if ($newPassword === $cnfpassword && $oldPassword != $newPassword) {
            $query = "UPDATE task3 SET passcode = '" . $newPassword . "'  WHERE id = '$uid' and passcode = '$oldPassword'";
            $result = mysqli_query($conn, $query);
            $sql = "SELECT passcode from task3 where id = '$uid'";
            $res = mysqli_query($conn, $sql);
            $cou = mysqli_num_rows($res);
            if($cou == 1){
                foreach($res as $row){
                    $pass = $row['passcode'];
                   }
                   if ($newPassword == $pass) {
               ?>
                       <html>
       
                       <body>
                           <script>
                               alert("Password Successfully Updated . Login Now !!!");
                               // document.getElementById("error").innerHTML = "First you should log in !!!!";
                               setTimeout(function() {
                                   window.location.replace("../");
                               }, 500);
                           </script>
                       </body>
       
                       </html>
       
                   <?php
                   
                   }else{
                    ?>
                    <html>
    
                    <body>
                        <script>
                            alert("Something went wrong . Try again !!!");
                            // document.getElementById("error").innerHTML = "First you should log in !!!!";
                            setTimeout(function() {
                                window.location.replace("../reset.php");
                            }, 500);
                        </script>
                    </body>
    
                    </html>
        <?php 
                   } 
            } else {

            ?>
                <html>

                <body>
                    <script>
                        alert("Something went wrong . Try again !!!");
                        // document.getElementById("error").innerHTML = "First you should log in !!!!";
                        setTimeout(function() {
                            window.location.replace("../reset.php");
                        }, 500);
                    </script>
                </body>

                </html>
    <?php
            }
        }
    } else {
        header("location:../");
    }
} else {
    ?>
    <html>

    <body>
        <script>
            alert("First you should log in !!!!");
            // document.getElementById("error").innerHTML = "First you should log in !!!!";
            setTimeout(function() {
                window.location.replace("../");
            }, 500);
        </script>
    </body>

    </html>

<?php
}
?>