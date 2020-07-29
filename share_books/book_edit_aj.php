<?php
require_once 'config.php' ;
session_start();
global $db;

if(@$_GET["mybook"]=="all"){
    $bsql="select * from bookinfo where userID =:userID ";
    $query = $db->prepare($bsql);
    $query->bindValue(":userID",$_SESSION["userID"], PDO::PARAM_INT);
    $query->execute();
    $vrow = array();
    while ($row =$query->fetch(PDO::FETCH_ASSOC)){
        // 加儲存陣列  
        array_push($vrow,$row);
     }
     echo json_encode($vrow);
}
//收到修改完成請求
if(isset($_POST["OKbtn"])){

    $esql = "update bookinfo set
        bookName = :bookName,
        author =  :author,
        bookType = :bookType,
        bookStatus = :bookStatus,
        wanted = :wanted,
        place = :place,
        where bookID = :bookID";
    
  $query = $db->prepare($esql);
  $query->bindValue(":bookName",$_POST["bookName"], PDO::PARAM_STR);
  $query->bindValue(":author",$_POST["author"], PDO::PARAM_STR);
  $query->bindValue(":bookType",$_POST["bookType"], PDO::PARAM_STR);
  $query->bindValue(":bookStatus",$_POST["bookStatus"], PDO::PARAM_STR);
  $query->bindValue(":wanted",$_POST["wanted"], PDO::PARAM_STR);
  $query->bindValue(":place",$_POST["place"], PDO::PARAM_STR);
  $query->bindValue(":bookID",$_POST["bookID"], PDO::PARAM_INT);
  $query->execute();

  header("location:book_edit.php?edit=eok");
  
}
if(isset($_POST["delect"])){
 
    $bookID = $_POST["delect"];
    $imgUrl_sql ="select bookImg from bookinfo where bookID = :bookID";
    $query = $db->prepare($imgUrl_sql);
    $query->bindValue(":bookID",$bookID , PDO::PARAM_STR);
    $query->execute();
    $imgrow =$query->fetch(PDO::FETCH_ASSOC);

    if(file_exists( $imgrow["bookImg"])){
        unlink( $imgrow["bookImg"]);
    };

    $dsql="delete from bookinfo where bookID = :bookID";
    $query = $db->prepare($dsql);
    $query->bindValue(":bookID",$bookID, PDO::PARAM_STR);
    $query->execute();

    echo "dOK";
    
}

?>