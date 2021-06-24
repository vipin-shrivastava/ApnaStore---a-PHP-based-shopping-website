<?php
session_start();


session_destroy();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>apnaStore : Kuch bhi Kabhi bhi</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <!--  Request me for a signup form or any type of help  -->
    <div class="login-form">
        <form action="controller/sendMail.php" method="post">
          
            <h4 class="modal-title">Forget Password</h4>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Enter email" required="required">
            </div>
            <input type="submit" name="Submit" class="btn btn-primary btn-block btn-lg" value="Reset">
        </form>
        <div class="text-center small">Want to try again? <a href="index.php">login</a></div>
    </div>
</body>

</html>


