

        else {

                        //  $statusMsg = "Sorry, there was an error uploading your file.";
?>
                        <html>

                        <body>
                            <script>
                                alert("Sorry, there was an error uploading your file.");
                                // document.getElementById("error").innerHTML = "First you should log in !!!!";
                                setTimeout(function() {
                                    window.location.replace("../panel.php");
                                }, 0);
                            </script>
                        </body>

                        </html>

                <?php

                    }
                }
            } else {
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';


                ?>
                <html>

                <body>
                    <script>
                        alert("Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.");
                        // document.getElementById("error").innerHTML = "First you should log in !!!!";
                        setTimeout(function() {
                            window.location.replace("panel.php");
                        }, 0);
                    </script>
                </body>

                </html>

            <?php
            }
        } else {

            if ($productname != "" && $productmodel == "" && $productprice == "" && $productstatus == "") {
                $query = "UPDATE products SET  pname='" . $productname . "' WHERE userid=$uid and pid =$pid ";
            } else if ($productname != "" && $productmodel != "" && $productprice == "" && $productstatus == "") {
                $query = "UPDATE products SET  pname='" . $productname . "' and pmodel='" . $productmodel . "'  WHERE userid=$uid and pid =$pid ";
            } else if ($productname != "" && $productmodel != "" && $productprice != "" && $productstatus == "") {
                $query = "UPDATE products SET  pname='" . $productname . "' and pmodel='" . $productmodel . "' and prate='" . $productprice . "'  WHERE userid=$uid and pid =$pid ";
            } else if ($productname != "" && $productmodel != "" && $productprice != "" && $productstatus != "") {
                $query = "UPDATE products SET  pname='" . $productname . "' , pmodel='" . $productmodel . "', prate='" . $productprice . "' , pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
            } else if ($productname == "" && $productmodel != "" && $productprice == "" && $productstatus == "") {
                $query = "UPDATE products SET  pmodel='" . $productmodel . "'  WHERE userid=$uid and pid =$pid ";
            } else if ($productname == "" && $productmodel != "" && $productprice != "" && $productstatus == "") {
                $query = "UPDATE products SET   pmodel='" . $productmodel . "' and prate='" . $productprice . "'   WHERE userid=$uid and pid =$pid ";
            } else if ($productname == "" && $productmodel != "" && $productprice != "" && $productstatus != "") {
                $query = "UPDATE products SET  pmodel='" . $productmodel . "' and prate='" . $productprice . "' and pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
            } else if ($productname == "" && $productmodel == "" && $productprice != "" && $productstatus == "") {
                $query = "UPDATE products SET  prate='" . $productprice . "'  WHERE userid=$uid and pid =$pid ";
            } else if ($productname == "" && $productmodel == "" && $productprice != "" && $productstatus != "") {
                $query = "UPDATE products SET  prate='" . $productprice . "' and pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
            } else if ($productname == "" && $productmodel == "" && $productprice == "" && $productstatus != "") {
                $query = "UPDATE products SET  pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
            } else {
            
            ?>
                <html>
            
                <body>
                    <script>
                        alert("Sorry, there was an error to update your data.");
                        // document.getElementById("error").innerHTML = "First you should log in !!!!";
                        setTimeout(function() {
                            window.location.replace("../panel.php");
                        }, 0);
                    </script>
                </body>
            
                </html>
            
            <?php
            }
            
            $result = mysqli_query($conn, $query)or die("Query failed.");



            $count = mysqli_affected_rows($conn);

             if($count == 1){
              $user = $_SESSION["login_user"];
          
            header("location:../panel.php");
             }
            
            
            //  $statusMsg = "Sorry, there was an error uploading your file.";
            }

        // Display status message
        echo $statusMsg;



        if ($productname == "" && $productmodel == "" && $productprice == "" && $productstatus == "") {
            $query = "UPDATE products SET pimage='" . $fileName . "' WHERE userid=$uid and pid =$pid ";
        } else if ($productname != "" && $productmodel == "" && $productprice == "" && $productstatus == "") {
            $query = "UPDATE products SET pimage='" . $fileName . "' and pname='" . $productname . "' WHERE userid=$uid and pid =$pid ";
        } else if ($productname != "" && $productmodel != "" && $productprice == "" && $productstatus == "") {
            $query = "UPDATE products SET pimage='" . $fileName . "' and pname='" . $productname . "' and pmodel='" . $productmodel . "'  WHERE userid=$uid and pid =$pid ";
        } else if ($productname != "" && $productmodel != "" && $productprice != "" && $productstatus == "") {
            $query = "UPDATE products SET pimage='" . $fileName . "' and pname='" . $productname . "' and pmodel='" . $productmodel . "' and prate='" . $productprice . "'  WHERE userid=$uid and pid =$pid ";
        } else if ($productname != "" && $productmodel != "" && $productprice != "" && $productstatus != "") {
            $query = "UPDATE products SET pimage='" . $fileName . "',  pname='" . $productname . "' , pmodel='" . $productmodel . "', prate='" . $productprice . "' , pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
        } else if ($productname == "" && $productmodel != "" && $productprice == "" && $productstatus == "") {
            $query = "UPDATE products SET pimage='" . $fileName . "' and pmodel='" . $productmodel . "'  WHERE userid=$uid and pid =$pid ";
        } else if ($productname == "" && $productmodel != "" && $productprice != "" && $productstatus == "") {
            $query = "UPDATE products SET pimage='" . $fileName . "' and  pmodel='" . $productmodel . "' and prate='" . $productprice . "'   WHERE userid=$uid and pid =$pid ";
        } else if ($productname == "" && $productmodel != "" && $productprice != "" && $productstatus != "") {
            $query = "UPDATE products SET pimage='" . $fileName . "' and pmodel='" . $productmodel . "' and prate='" . $productprice . "' and pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
        } else if ($productname == "" && $productmodel == "" && $productprice != "" && $productstatus == "") {
            $query = "UPDATE products SET pimage='" . $fileName . "'  and prate='" . $productprice . "'  WHERE userid=$uid and pid =$pid ";
        } else if ($productname == "" && $productmodel == "" && $productprice != "" && $productstatus != "") {
            $query = "UPDATE products SET pimage='" . $fileName . "'  and prate='" . $productprice . "' and pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
        } else if ($productname == "" && $productmodel == "" && $productprice == "" && $productstatus != "") {
            $query = "UPDATE products SET pimage='" . $fileName . "' and pstatus='" . $productstatus . "'  WHERE userid=$uid and pid =$pid ";
        }