<?php 
    require_once 'config.php';
    require_once 'login.php'; 
 
if(isset($_POST["okBtn"]) && $row>0){
    header("location:book_edit.php");
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrsp 引用 -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/index.css">
    <title>share_books</title>

</head>
<body>
<div class="row no-gutters">
   <div class="leftBox col-sm-12 col-md-6">
       <h1>SHaRe Books</h1>
       <canvas id="mycan"></canvas>
   </div>
   <div class="rightBox col-sm-12 col-md-6">
       <div class="searchBox">
           <img src="img/books_icon.png" alt="">
           <a href="searchbook.php">Search...</a>
       </div>
       <div class="memberBox">
            <img src="img/user_icon.png" alt="">
            <p>Member...</p>
        </div>
   </div>
</div>
<!-- 會員登入視窗 -->
<div class="loginBox">
    <div class="icon_close"><i class="fa fa-close"></i></div>
    <form method="post" class="col-sm-12 col-md-6" action="">
      <?php if(isset($_POST["okBtn"]) && !$row): ?>
      <p class="apcheck">請確認帳號密碼</p>
      <?php endif ; ?>
             <div class="form-group">
                 <label for="userID">帳號</label>
                 <input type="text" name="userAccount" class="form-control" id="userID" placeholder="Enter 帳號" required>
             </div>
             <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
             </div>
             <div class="btn_group">
                <button type="button" class="btn btn_green" onclick="window.open('member_join.php')">加入會員</button>
                <button type="submit" name="okBtn" class="btn btn_yellow">Login</button>    
            </div>    
        </form>
    </div>


<script src="js/coreFn.js"></script>
<script src="js/index_canvas.js"></script>

<script>
var check_login = <?php echo  (int)isset($_SESSION["userID"]); ?>;
$('.memberBox p').on('click',openLoginBox);

//開啟會員登入視窗
function openLoginBox(){
    if(check_login == 0){
    $('.loginBox').fadeIn(300);
    }
    else{
        document.location.href="book_edit.php";
    }
} 


</script>
</body>
</html>