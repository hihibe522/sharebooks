<?php require_once 'config.php' ;?>
<?php include_once 'header.php' ;?>
<?php
if(isset($_POST["btnOK"])){
    
    $sql ="insert into userinfo
    (userAccount,userName,password,email)
    values
    ('{$_POST["userAccount"]}','{$_POST["userName"]}','{$_POST["password"]}','{$_POST["email"]}')";
    mysqli_query($link,$sql);
    header("location:searchbook.php?lgB=1");
 
    exit();

}

?>
<link rel="stylesheet" href="css/login.css">
<!-- navbar引用 -->
<?php include_once 'navbar.php' ;?>

    <div class="container">
        <div><h1>會員註冊</h1></div>

        <form class="join_form" method="post" action="">
            <div class="form-group">
                <label for="userAccount">帳號</label>
                <input type="text" name="userAccount" class="form-control" id="userAccount" placeholder="請輸入英數字" required >
            </div>
            <div class="form-group">
                <label for="u_password">Password</label>
                <input type="password" name="password" id="u_password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="c_password" placeholder="請再次輸入Password">
            <p class="psdText">請確認輸入之密碼是否相同</p>
            </div>
            <div class="form-group">
                <label for="userName">暱稱</label>
                <input type="text" name="userName" class="form-control" id="userName" placeholder="請輸入暱稱" required>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
            </div>
              
            <button type="submit" name="btnOK" class="btn btn_blue">Submit</button>
          </form>
    </div>
    <?php include_once 'footer_info.php'; ?>

    <script>
    
    //確認兩次輸入密碼是否相同
    $('#c_password').change(checkpsd);
    function checkpsd() {     
        console.log($('#c_password').val());  
        console.log($('#u_password').val());
    if($('#c_password').val() != $('#u_password').val()){
        $('.psdText').css('display','block');
        }else{
            $('.psdText').css('display','none');  
        }
    }
    
    </script>
   
  
<?php include_once 'footer.php'; ?>