<?php

session_start();

if(isset($_POST["okBtn"])){    
  $sql = "select * from userinfo 
  where userAccount='{$_POST["userAccount"]}' and password = '{$_POST["password"]}' ";
  // echo $sql;
  $res = mysqli_query($link,$sql);
  $row = mysqli_fetch_assoc($res);
  if($row){
    $_SESSION["userID"] = $row["userID"];
    $_SESSION["userName"] = $row["userName"];
  }
  else{

      echo "<script> alert('請確認帳號密碼') ;</script>";

  }
}
   

  $userName = "Guest";
  if(isset($_SESSION["userID"])){
    $userName = $_SESSION["userName"];  
  }
  else{
    $userName = "Guest";
  }

?>