<?php

session_start();

if($_SESSION["login_user"] != null){
    $_SESSION["logging"] = 0 ;
    header("location:../");
}else{
    header("location:../");
}
