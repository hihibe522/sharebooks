<?php
require_once 'config.php' ;
session_start();
// global $db ;

$myID = $_SESSION["userID"];
$myName = $_SESSION["userName"];

if(isset($_POST["search"])){
    // global $db, $myID ;
    $type = $_POST["search"];
    switch ($type){

		case "all":
            $sql= "select * from bookorder where ucheck = 1 and (user= :userID or pasuser = :userID)";
            $query = $db->prepare($sql);
            $query->bindValue(":userID",$myID, PDO::PARAM_INT);
            $query->execute();
            break;
        
        case "receive":
            $sql= "select * from bookorder where ucheck = 1 and  pasuser = :userID";
            $query = $db->prepare($sql);
            $query->bindValue(":userID",$myID, PDO::PARAM_INT);
            $query->execute();
            break;

        case "send":
            $sql= "select * from bookorder where ucheck = 1 and  user = :userID";
            $query = $db->prepare($sql);
            $query->bindValue(":userID",$myID, PDO::PARAM_INT);
            $query->execute();
            break;

        default:
			echo "unknown";
        }

        $vmyrow = array();
        while($myrow = $query->fetch(PDO::FETCH_ASSOC)){
            if(is_file($myrow["userbookImg"]) && is_file($myrow["pasbookImg"])){
                array_push($vmyrow,$myrow);
            }
        }
        echo json_encode($vmyrow);

}
if(isset($_POST["history"])){
    // global $db,$myID;
    $type = $_POST["history"];
    switch ($type){

		case "all":
            $sql= "select * from bookorder where (complete = 1 or deny = 1) and (user= :userID or pasuser = :userID)";
            $query = $db->prepare($sql);
            $query->bindValue(":userID",$myID, PDO::PARAM_INT);
            $query->execute();
            break;
        
        case "success":
            $sql= "select * from bookorder where complete = 1 and  (user= :userID or pasuser = :userID)";
            $query = $db->prepare($sql);
            $query->bindValue(":userID",$myID, PDO::PARAM_INT);
            $query->execute();
            break;

        case "fail":
            $sql= "select * from bookorder where deny = 1 and  (user= :userID or pasuser = :userID)";
            $query = $db->prepare($sql);
            $query->bindValue(":userID",$myID, PDO::PARAM_INT);
            $query->execute();
            break;

        default:
			echo "unknown";
        }

        $vmyrow = array();
        while($myrow = $query->fetch(PDO::FETCH_ASSOC)){
            if(is_file($myrow["userbookImg"]) && is_file($myrow["pasbookImg"])){
                array_push($vmyrow,$myrow);
            }
        }
        echo json_encode($vmyrow);

}





if(isset($_POST["project"]) && $_POST["project"] != ""){
    // global $db,$myID;
    $orderID = $_POST["project"];  
    $data = array();
    $sql = "select * from bookorder where orderID = :orderID ";
    $query = $db->prepare($sql);
    $query->bindValue(":orderID",$orderID, PDO::PARAM_INT);
    $query->execute();
    $orow = $query->fetch(PDO::FETCH_ASSOC);
    $orderPerson = $orow["user"];
    $ordermsg = $orow["ordermsg"];


    
    if($orderPerson == $myID ){
        // "送出的邀請"
        $pasbook = $orow["pasbook"];
        $booksql ="SELECT b.*,u.userName FROM bookinfo b LEFT JOIN userinfo u ON b.userID = u.userID where bookID =:bookID ";
        $query = $db->prepare($booksql);
        $query->bindValue(":bookID",$pasbook, PDO::PARAM_INT);
        $query->execute();
        $brow = $query->fetch(PDO::FETCH_ASSOC);
        $data["type"] = "送出的邀請";
    }
    else{
        // "收到的邀請"
        $pasbook = $orow["userbook"];
        $booksql ="SELECT b.*,u.userName FROM bookinfo b LEFT JOIN userinfo u ON b.userID = u.userID where bookID =:bookID ";
        $query = $db->prepare($booksql);
        $query->bindValue(":bookID",$pasbook, PDO::PARAM_INT);
        $query->execute();
        $brow = $query->fetch(PDO::FETCH_ASSOC);
        $data["type"] = "收到的邀請";
        // echo json_encode($brow);
        // var_dump($brow);
    }
        $data["order"] = $orow;
        // $data["orderID"] = $orderID;
        $data["msg"] = $ordermsg;
        $data["detail"] = $brow ;
        echo json_encode($data);
        exit();
// $group_search_data = $group_search->fetchAll(\PDO::FETCH_ASSOC);
// $group_data = array();
// foreach ($group_search_data as $key => $value) {
// 	$group_data[$key]["group_id"] = $value["group_id"];
// 	$group_data[$key]["group_nm"] = $value["group_nm"];
}

//處理交換動作相關
if(isset($_POST["sendMsg"])){
    // global $db , $myID , $myName ;
    $msql= "select ordermsg from bookorder where orderID=:orderID ";
    $query = $db->prepare($msql);
    $query->bindValue(":orderID",$_POST["projectID"], PDO::PARAM_INT);
    $query->execute();
    $mrow = $query->fetch(PDO::FETCH_ASSOC);
    $msg = $mrow["ordermsg"];
    $newmsg = $myName.":".$_POST["newMsg"];
    $msg =$msg.$newmsg."X@@X";
    echo $msg;  
    $sql= "update bookorder set ordermsg = :msg where orderID =:orderID ";
    $query = $db->prepare($sql);
    $query->bindValue(":msg",$msg, PDO::PARAM_STR);
    $query->bindValue(":orderID",$_POST["projectID"], PDO::PARAM_INT);
    $query->execute();  

    if(isset($_POST["hisMsg"])){
        header("location:history.php");
        exit();
    }

    header("location:book_storage.php");

}


if(isset($_POST["cancleBtn"]) || isset($_POST["denyBtn"]) || isset($_POST["agreeBtn"]) ){

    // global $db ;
    $sql1= "select * from bookorder where orderID = :orderID";
    $query = $db->prepare($sql1);
    $query->bindValue(":orderID",$_POST["projectID"], PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);
    $mybook = $row["userbook"];
    $pasbook = $row["pasbook"];
    
    //取消邀請
    if(isset($_POST["cancleBtn"])){

        // 自己的書重新上架
        $sql2 = "update bookinfo set unable = '1' where bookID = :bookID "; 
        $query = $db->prepare($sql2);
        $query->bindValue(":bookID",$mybook, PDO::PARAM_INT);
        $query->execute();

        //取消bookorder
        $sql3 = "update bookorder set ucheck = '0' where orderID = :orderID ";
        $query = $db->prepare($sql3);
        $query->bindValue(":orderID",$_POST["projectID"], PDO::PARAM_INT);
        $query->execute();

        header('location:book_storage.php?c=ok');
    }

    //拒絕邀請
    if(isset($_POST["denyBtn"])){

        // 將對方的書重新上架
        $sql2 = "update bookinfo set unable = '1' where bookID = :bookID "; 
        $query = $db->prepare($sql2);
        $query->bindValue(":bookID",$mybook, PDO::PARAM_INT);
        $query->execute();

        //更改bookorder 
        $sql3 = "update bookorder set ucheck = '0', deny = '1' where orderID = :orderID ";
        $query = $db->prepare($sql3);
        $query->bindValue(":orderID",$_POST["projectID"], PDO::PARAM_INT);
        $query->execute();

        header('location:book_storage.php?d=ok');
    }
    
    //同意邀請
    if(isset($_POST["agreeBtn"])){

        //將自己的書下架
        $sql2 = "update bookinfo set unable = '0' where bookID = :bookID "; 
        $query = $db->prepare($sql2);
        $query->bindValue(":bookID",$pasbook, PDO::PARAM_INT);
        $query->execute();

        //更新bookorder  "ucheck"/"complete"
        $sql3 = "update bookorder set ucheck = '0', complete = '1' where orderID = :orderID ";
        $query = $db->prepare($sql3);
        $query->bindValue(":orderID",$_POST["projectID"], PDO::PARAM_INT);
        $query->execute();

        header('location:book_storage.php?a=ok');
    }


}











?>