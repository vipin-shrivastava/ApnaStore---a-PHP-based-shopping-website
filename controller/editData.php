<?php
session_start();

include("../connection/connection.php");

if ($_SESSION['login_user'] != null) {
    if ($_SESSION['logging'] == 1) {




        $statusMsg = '';

        $productname = $_POST["product_name"];
        $productmodel = $_POST["product_model"];
        $productprice = $_POST["product_price"];
        $productstatus = $_POST["product_status"];
        $uid = $_SESSION["user_id"];
        $pid = $_POST["product_id"];
        $maxsize    = 2097152;
        // // File upload path
        $targetDir = "../uploads/";
        $fileName = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);




        if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {

            // Allow certain file formats
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0)) {

                    $statusMsg = 'File too large. File must be less than 2 megabytes.';

                    echo "2 kb se baadi haikya bolu";
                } else {

                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {



                        // Insert image file name into database

                        $query = "UPDATE products SET pimage='" . $fileName . "',  pname='" . $productname . "' , pmodel='" . $productmodel . "', prate='" . $productprice . "' , pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";

                        $result = mysqli_query($conn, $query) or die("Query failed.");



                        $count = mysqli_affected_rows($conn);

                        if ($count == 1) {
                            $user = $_SESSION["login_user"];

                            header("location:../panel.php");
                        }
                    } else {
                        echo "folder mai nhi jaara";
                    }
                }
            } else {
                echo "Yaha pr hi dikkat hai";
            }
        } else {
            $query = "UPDATE products SET  pname='" . $productname . "' , pmodel='" . $productmodel . "', prate='" . $productprice . "' , pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
            $result = mysqli_query($conn, $query) or die("Query failed.");
            $count = mysqli_affected_rows($conn);
            if ($count == 1) {
                header("location:../panel.php");
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