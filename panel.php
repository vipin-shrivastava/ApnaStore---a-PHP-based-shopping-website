<?php
session_start();
include("connection/connection.php");


if ($_SESSION["login_user"] != null) {

    if ($_SESSION['logging'] == 1) {
?>

        <html>

        <head>
            <title>
                Welcome <?php echo $_SESSION["login_user"]; ?>
            </title>

            <link rel="stylesheet" href="css/header.css">
            <link rel="stylesheet" href="css/panel.css">
            <link rel="stylesheet" href="css/tooltips.css">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        </head>

        <body>
            <!-- //---------------------------------------- Header ----------------------------------------------- -->
            <div class="header">
                <a class="logo"><?php echo ucfirst($_SESSION["login_user"]); ?></a>
                <div class="header-right">
                    <!-- <a class="active" href="#home">Home</a> -->
                    <a href="reset.php">Reset-Password</a>
                    <a href="controller/logout.php">Logout</a>
                </div>
            </div>
            <!-- //---------------------------------Data Visulatization In Table form ----------------------------- -->
            <div id="table">
                <table id="customers">
                    <tr>
                        <th>S.No</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Model</th>
                        <th>Product Price</th>
                        <th>Product Status</th>
                        <th>Product Modification</th>
                    </tr>
                    <?php

                    $query = "SELECT * FROM products Where userid = " . $_SESSION['user_id'];
                    $result = mysqli_query($conn, $query);

                    $count = mysqli_num_rows($result);
                    $i = 1;
                    if ($count > 0) {
                        foreach ($result as $row) {

                            $Qid = $row["pid"];
                            $Qimage = $row['pimage'];
                            $Qname = $row["pname"];
                            $Qmodel = $row["pmodel"];
                            $Qrate = $row["prate"];
                            $Qstatus = $row["pstatus"];




                            echo '
                         <tr >
                            <td  class="tooltip" onclick="myFunction(' . $Qid . ',' . "'uploads/$Qimage'" . ',' . "'$Qname'" . ',' . "'$Qmodel'" . ',' . "'$Qrate'" . ',' . "'$Qstatus'" . ')">' . '<span class="tooltiptext">Click Me</span> ' . $i . '</td>
                            <td>' . '<img src="uploads/' . $row['pimage'] . '" height="100" width="100" onClick="image(this)" />' . '</td>
                            <td>' . $row["pname"] . ' </td>
                            <td>' . $row["pmodel"] . '</td>
                            <td>' . $row["prate"] . ".00 ₹" . '</td>
                            <td>' . $row["pstatus"] . '</td>
                            <td>' . '<a style="text-decoration:none" href="controller/deleteData.php?uname=' . $_SESSION["login_user"] . '&deleteData=delete&id=' . $row["pid"] . '" onclick="return confirm(\'Are you sure to delete?\')" >Delete</a>  ||  <a style="text-decoration:none" href="#" onclick="myFunction(' . $Qid . ',' . "'uploads/$Qimage'" . ',' . "'$Qname'" . ',' . "'$Qmodel'" . ',' . "'$Qrate'" . ',' . "'$Qstatus'" . ')">Edit</a>' . '</td>
                          </tr>';
                            $i++;
                        }
                    }
                    //|| ' . '<a href="editData(' . $row["pid"] . ')">Edit</a>' 
                    ?>
                </table>
            </div>

            <script>
                function image(img) {
                    var src = img.src;
                    window.open(src);
                }


                function confirmation() {
                    var result = confirm("Are you sure to delete?");
                    if (result) {
                        // Delete logic goes here
                    }
                }

                function myFunction(id, image, name, model, rate, status) {
                    document.getElementById("myId").value = id;
                    document.getElementById("myImg").src = image;
                    document.getElementById("name").value = name;
                    document.getElementById("model").value = model;
                    document.getElementById("price").value = rate;
                    document.getElementById("status").value = status;

                    document.getElementById('id01').style.display = 'block';
                }
            </script>
            <!-- //--------------------------------- POP UP Insert Button ------------------------------------------ -->

            <button class="open-button" onclick="openForm()">Insert Data</button>

            <div class="form-popup" id="myForm">
                <form action="controller/insertData.php" class="form-container" method="post" enctype='multipart/form-data'>
                    <h1>Insert Product Data</h1>

                    <label for="psw"><b>Upload Product Image</b></label>
                    <br>
                    <input type="file" name="file" />
                    <br>
                    <br>

                    <label for="product-name"><b>Product Name</b></label>
                    <input type="text"  placeholder="Enter Product Name" onkeyup="checkPass();" name="product_name" required>


                    <label for="product-model"><b>Product Model</b></label>
                    <input type="text"  placeholder="Enter Product Model"  onkeyup="checkPass();" name="product_model" required>

                    <label for="product-price"><b>Product Price</b></label>
                    <input type="text" placeholder="Enter Product Price" name="product_price"   oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" required>

                    <label for="product-status"><b>Product Status</b></label>
                    <select id="status" class="input-text" name="product_status">
                        <option value="Available">Available</option>
                        <option value="Not Available">Not Available</option>
                    </select>

                    <button type="submit" class="btn" name="submit" value="Upload">Insert Data</button>
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>

            <!-- ================== Edit form ====================== -->

            <div id="id01" class="modal">

                <form class="modal-content animate" action="controller/editData.php" method="post" enctype='multipart/form-data'>
                    <div class="imgcontainer">
                        <div id="targetLayer"></div>
                        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <img id="myImg" src="" alt="Avatar" class="avatar">
                    </div>
                    <input type="file" name="file" id="userImage" class="inputFile" onChange="showPreview(this);" />
                    <div class="container">

                        <label for="Product-ID"><b>Product ID</b></label>
                        <input type="text" placeholder="Dont Change this" id="myId" name="product_id" readonly>
                        <!-- <label for="Product-Image"><b>Product Image</b></label>
                        <input type="file" name="file" /> -->
                        <label for="Product-Name"><b>Product Name</b></label>
                        <input type="text"  placeholder="Enter Product Name" id="name" name="product_name" onkeyup="checkPass();" required>
                        <div id="error-nwl"></div>
                        <label for="Product-Model"><b>Product Model</b></label>
                        <input type="text" placeholder="Enter Product Model" id="model"  onkeyup="checkPass();" name="product_model" required>
                        <div id="error-model-nwl"></div>
                        <label for="Product-Price"><b>Product Price</b></label>
                        <input type="text" placeholder="Enter Product Price" id="price" name="product_price" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required>

                        <label for="Product-Status"><b>Product Status</b></label>
                        <select id="status" class="input-text" name="product_status">
                            <option value="Available">Available</option>
                            <option value="Not Available">Not Available</option>
                        </select>

                        <button type="submit" class="btn" name="submit" value="Edit">Update</button>

                    </div>

                    <div class="container" style="background-color:#f1f1f1">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    </div>
                </form>
            </div>




            <script type="text/javascript">
                function checkPass() {
                    var pass1 = document.getElementById('name');
                    var pass2 = document.getElementById('model');
                    // var pass2 = document.getElementById('pass2');
                    var message = document.getElementById('error-nwl');
                    var message1 = document.getElementById('error-model-nwl');
                    var goodColor = "#66cc66";
                    var badColor = "#ff6666";

                    if (pass1.value.length < 16) {
                        pass1.style.backgroundColor = goodColor;
                        message.style.color = goodColor;
                        message.innerHTML = ""
                    } else {
                        pass1.style.backgroundColor = badColor;
                        message.style.color = badColor;
                        message.innerHTML = " you have not enter more than 15 digit!"
                        return;
                    }

                    if (pass2.value.length < 16) {
                        pass2.style.backgroundColor = goodColor;
                        message1.style.color = goodColor;
                        message1.innerHTML = ""
                    } else {
                        pass2.style.backgroundColor = badColor;
                        message1.style.color = badColor;
                        message1.innerHTML = " you have not enter more than 15 digit!"
                        return;
                    }
                }







                function showPreview(objFileInput) {
                    if (objFileInput.files[0]) {
                        var fileReader = new FileReader();
                        fileReader.onload = function(e) {
                            $('#myImg').attr('src', e.target.result);
                            $("#myImg").html(e.target.result);
                        }
                        fileReader.readAsDataURL(objFileInput.files[0]);
                    }
                }











                var modal = document.getElementById('id01');

                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = "none";
                    }
                }






                //==================================================================================



                function validateForm() {

                    var z = document.forms["myEditForm"]["product_price"].value;

                    if (!/^[0-9]+$/.test(z)) {
                        alert("Please only enter numeric characters only for your Age! (Allowed input:0-9)")
                    }

                }



                function openForm() {
                    document.getElementById("myForm").style.display = "block";
                }

                function closeForm() {
                    document.getElementById("myForm").style.display = "none";
                }
            </script>
        </body>

        </html>


<?php



    } else {

        header("location:index.php");
    }
} else {

    header("location:index.php");
}




?>