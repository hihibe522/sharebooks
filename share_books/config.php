<?php
    $dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
    $dbname = 'sharebook';
   try{ 
    $db = new PDO("mysql:host={$dbhost};dbname={$dbname};charset=utf8", $dbuser,$dbpass);
    // $db->exec("set names utf8");
    }
    catch(PDOException $e){
        echo "資料庫連線失敗: $e->getMessage()"; 
    }


    $link = mysqli_connect ( $dbhost, $dbuser, $dbpass ) or die ( mysqli_connect_error() );
    mysqli_select_db ($link, $dbname);

    if($link->connect_error !=""){
        echo "資料庫連線失敗";
    }
    else{
        $result = mysqli_query ( $link, "set names utf8" );
    }



?>