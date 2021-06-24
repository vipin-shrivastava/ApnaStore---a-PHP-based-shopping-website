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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <!--  Request me for a signup form or any type of help  -->
    <div class="login-form">
        <form action="controller/register_check.php" method="post">
            <div class="avatar"><i class="material-icons">&#xE7FF;</i></div>
            <h4 class="modal-title">Register</h4>
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" onBlur="checkAvailability()" class="demoInputBox" required="required"><span id="user-availability-status"></span>
                <p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
            </div>
            <div class="form-group">
                <input type="email" id="email" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" class="form-control" name="email" placeholder="Email" required="required">
            </div>
            <div class="form-group">
                <input type="password" id="password" class="form-control" name="password" placeholder="Password" onkeyup="CheckPasswordStrength(this.value)" required="required">
            </div>
            <span id="password_strength"></span>
            <span id='message'></span>
            <div class="form-group">
                <input type="password" id="cnf_password" class="form-control" name="cnfpass" placeholder="Confirm Password" required="required">
            </div>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Register">
        </form>
        <div class="text-center small">Already have an account? <a href="index.php">Login</a></div>
    </div>




    <script>
        function CheckPasswordStrength(password) {
            var password_strength = document.getElementById("password_strength");

            //TextBox left blank.
            if (password.length == 0) {
                password_strength.innerHTML = "";
                return;
            }

            //Regular Expressions.
            var regex = new Array();
            regex.push("[A-Z]"); //Uppercase Alphabet.
            regex.push("[a-z]"); //Lowercase Alphabet.
            regex.push("[0-9]"); //Digit.
            regex.push("[$@$!%*#?&]"); //Special Character.

            var passed = 0;

            //Validate for each Regular Expression.
            for (var i = 0; i < regex.length; i++) {
                if (new RegExp(regex[i]).test(password)) {
                    passed++;
                }
            }

            //Validate for length of Password.
            if (passed > 8 && password.length > 15) {
                passed++;
            }

            //Display status.
            var color = "";
            var strength = "";
            switch (passed) {
                case 0:
                case 1:
                    strength = "Weak";
                    color = "red";
                    break;
                case 2:
                    strength = "Good";
                    color = "darkorange";
                    break;
                case 3:
                case 4:
                    strength = "Strong";
                    color = "green";
                    break;
                case 5:
                    strength = "Very Strong";
                    color = "darkgreen";
                    break;
            }
            password_strength.innerHTML = strength;
            password_strength.style.color = color;
        }

        $('#password, #cnf_password').on('keyup', function() {

            if ($('#password').val() != "" && $('#cnf_password').val() != "") {
                if ($('#password').val() == $('#cnf_password').val()) {
                    $('#message').html('Matched').css('color', 'green');
                    $(':input[type="submit"]').prop('disabled', false);
                } else {
                    $('#message').html('Not Matching').css('color', 'red');
                    $(':input[type="submit"]').prop('disabled', true);
                }
                // $(':input[type="submit"]').prop('disabled', true);
            }


        });




        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "controller/check_availability.php",
                data: 'username=' + $("#username").val(),
                type: "POST",
                success: function(data) {
                    $("#user-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>
</body>

</html>