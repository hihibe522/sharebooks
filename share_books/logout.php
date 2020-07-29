<?php
require_once 'config.php' ;
session_start();

if(isset($_GET["logout"]) && ($_GET["logout"] == 1)){

    unset($_SESSION["userId"]);
    unset($_SESSION["userName"]);
    session_destroy();
    header("location:searchbook.php");

}







?>