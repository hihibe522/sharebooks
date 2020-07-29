
<?php
require_once 'config.php' ;
session_start();

//搜尋全部書單
if( @$_POST["search"]=="all"){
    $vrow = totalBooks();
    // echo $vrow;
    echo json_encode($vrow);

}
if(isset($_POST["mysearch"])){
    // global $db;
    $search = $_POST["mysearch"];
    $search = '%'.$search.'%';
    $sql="select bookID,bookName,author,bookType,
    bookStatus,wanted,place,b.userID,bookImg,updateTime,unable,u.userName
    from bookinfo b left join userinfo u  on b.userID = u.userID where b.unable = 1 and
    (b.bookName like :search or b.author like :search) order by bookID DESC";
    $query = $db->prepare($sql);
    $query->bindValue(":search",$search , PDO::PARAM_STR);
    $query->execute();
    $vrow = array();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        array_push($vrow,$row);
    }
     echo json_encode($vrow);
    
}


//交換書單ajax

//還沒登入
if(isset($_POST["change"]) && !isset($_SESSION["userID"]) ){  
    echo "xxx";
}
//換到自己得書
if(isset($_POST["change"]) && @$_SESSION["userID"] == $_POST["bookOwner"]){
    echo "self";
}
//一般正常流程
if(isset($_POST["change"]) && @$_SESSION["userID"] != $_POST["bookOwner"] && isset($_SESSION["userID"])){
    global $db;
    $myID = @$_SESSION["userID"];
    $mybooksql= "select bookID,bookName from bookinfo where userID =:userID and unable = 1 " ;
    $query = $db->prepare($mybooksql);
    $query->bindValue(":userID", $myID , PDO::PARAM_STR);
    $query->execute();
    $vmyrow = array();
    while($myrow = $query->fetch(PDO::FETCH_ASSOC)){
        array_push($vmyrow,$myrow);
    }
     echo json_encode($vmyrow);
}


if(isset($_POST["changebtn"])){

    global $db;
    $myID = $_SESSION["userID"];
    $myName = $_SESSION["userName"];
    $ordermsg = $_POST["ordermsg"];
    $ordermsg = $myName.":".$ordermsg."X@@X";
    $sql ="select bookID,bookName,bookImg from bookinfo where bookID = :mybook";
    $query = $db->prepare($sql);
    $query->bindValue(":mybook",$_POST["mybook"], PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $mybookName = $row["bookName"];
    $mybookImg = $row["bookImg"];
    // echo $mybookImg ;

    $sql2 ="select bookID,bookName,author,bookImg from bookinfo where bookID = :mybook";
    $query = $db->prepare($sql2);
    $query->bindValue(":mybook",$_POST["pasbook"], PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $pasbookName = $row["bookName"];
    $pasbookImg = $row["bookImg"];
    // echo $pasbookImg;

    $sql3 ="select userName from userinfo where userID = :pasuser";
    $query = $db->prepare($sql3);
    $query->bindValue(":pasuser",$_POST["pasuser"], PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $pasuserName =  $row["userName"];
    // echo $pasuserName;

    $sql4 ="select userName from userinfo where userID = :userID";
    $query = $db->prepare($sql4);
    $query->bindValue(":userID",$myID, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $myName = $row["userName"];
    // echo $myName;
    $bookordersql = 
    "insert into bookorder
    (user,userName,userbook,userbookName,userbookImg,pasuser,pasuserName,pasbook,pasbookName,pasbookImg,ordermsg)
    values
    (:user,:userName,:userbook,:userbookName,:userbookImg,:pasuser,:pasuserName,:pasbook,:pasbookName,:pasbookImg,:ordermsg)";
    $query = $db->prepare($bookordersql);
    
    $query->bindValue(":user",$myID, PDO::PARAM_INT);
    $query->bindValue(":userName",$myName, PDO::PARAM_STR);
    $query->bindValue(":userbook",$_POST["mybook"], PDO::PARAM_INT);
    $query->bindValue(":userbookName",$mybookName, PDO::PARAM_STR);
    $query->bindValue(":userbookImg",$mybookImg, PDO::PARAM_STR);
    $query->bindValue(":pasuser",$_POST["pasuser"], PDO::PARAM_INT);
    $query->bindValue(":pasuserName",$pasuserName, PDO::PARAM_STR);
    $query->bindValue(":pasbook",$_POST["pasbook"], PDO::PARAM_INT);
    $query->bindValue(":pasbookName", $pasbookName, PDO::PARAM_STR);
    $query->bindValue(":pasbookImg",$pasbookImg, PDO::PARAM_STR);
    $query->bindValue(":ordermsg",$ordermsg, PDO::PARAM_STR);
    $query->execute();

    // 將自已的書先下架
    $mybookupdatesql = "update bookinfo set unable = '0' where bookID = :mybook";
    $query = $db->prepare($mybookupdatesql);
    $query->bindValue(":mybook",$_POST["mybook"], PDO::PARAM_INT);
    $query->execute();

    header("location:searchbook.php?cha=ok");

}



function totalBooks(){
    global $db;
    $booksql = "select bookID,bookName,author,bookType,
                bookStatus,wanted,place,b.userID,bookImg,updateTime,unable,u.userName
                from bookinfo b left join userinfo u  on b.userID = u.userID where b.unable = 1
                order by bookID DESC";
    $query = $db->prepare($booksql);
    $res =  $query->execute();
    $vrow = array();
    while ($row =$query->fetch(PDO::FETCH_ASSOC)){
        // 加儲存陣列
        array_push($vrow,$row);     
     }
    return $vrow ;
    // echo json_encode($vrow);
}





?>