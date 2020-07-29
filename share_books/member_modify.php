<?php require_once 'config.php' ;?>
<?php include_once 'header.php' ;?>

<link rel="stylesheet" href="css/main_member.css">
<!-- navbar引用 -->
<?php include_once 'navbar.php' ;?>


<?php 
    if(!isset($_SESSION["userID"]) && @$_SESSION["userID"]==""){
        echo " <script> loginBoxIn(); </script>";
        echo "請先進行登入";
        exit();
    }
    
    $id = isset($_GET["uid"])? $_GET["uid"] : $_SESSION["userID"] ;
    $usql = "select * from userinfo where  userID = $id" ;
    $ures = mysqli_query($link,$usql);
    $urow = mysqli_fetch_assoc($ures);



    if(isset($_POST["editOkBtn"])){

        $sql = "update userinfo set 
        userAccount = '{$_POST["userAccount"]}',
        password = '{$_POST["password"]}',
        userName = '{$_POST["userName"]}',
        email = '{$_POST["email"]}'
        where userID = '{$_POST["userID"]}'";   
        mysqli_query($link,$sql);
        
        header("location:member_modify.php?edit=ok");

    }
?>

<div aria-live="polite" aria-atomic="true" >
  <div id="ttt" class="toast" data-delay="700">
    <div class="toast-header">
        <strong class="mr-auto">ShareBooks</strong>
    </div>
    <div class="toast-body">帳號資料更新成功!!</div>
  </div>
</div>

    <h1>修改會員資料</h1>
    <div class="hr_line"></div>
    <!--form content-->
    <section class="container">
        <form method="post" action="" class="col-sm-12 col-md-8">
        <input type="hidden" name="userID" value="<?=$urow["userID"] ?>">
        <div class="form-group">
                <label for="userAccount">帳號</label>
                <input type="text" name="userAccount" value="<?=$urow["userAccount"] ?>" class="form-control" id="userAccount" required >
            </div>
            <div class="form-group">
                <label for="u_password">Password</label>
                <input type="password" name="password" id="u_password"  value="<?=$urow["password"] ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="userName">暱稱</label>
                <input type="text" name="userName" class="form-control" id="userName" value="<?=$urow["userName"] ?>" required>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" name="email" class="form-control" id="email" value="<?=$urow["email"] ?>" required>
            </div>        
            <button type="submit" name="editOkBtn" class="btn btn_blue">Submit</button>
          </form>
    </section>    

<?php include_once 'footer_info.php'; ?>
<script>
var editOK = location.search;
if(editOK){

    $('#ttt').toast('show');
}
</script>

<!-- footer -->
<?php include_once 'footer.php'; ?>