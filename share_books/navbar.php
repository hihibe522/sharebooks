<?php require_once 'config.php';?>
<script src="js/coreFn.js"></script> 
<?php require_once 'login.php'; ?>

</head>
<body>
<nav class="nav navbar navbar-expand-lg">
    <a class="navbar-brand" href="index.php">SHaRe Books</a>  
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon icon"></span>
      </button>
         
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto"> 
          <li class="nav-item">
            <a class="nav-link" href="searchbook.php">搜尋書本</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="member_modify.php" >會員帳號管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="book_edit.php">我的書本管理</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="book_storage.php">接洽中書單</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="history.php">交換紀錄</a>
          </li>
        </ul>
        <ul class="ml-auto loginBtn">
          <li class="nav-item">Hello !! <span><?= $userName  ?> </span></li>
          <?php if( $userName == "Guest"): ?>
            <li class="nav-item">
              <a class="nav-link" id="user_Login" onclick="return false" href="#">登入</a>
            </li>
            <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" id="user_Logout" href="logout.php?logout=1">登出</a>
            </li>
          <?php endif ;?>
          
        </ul>
      </div>
</nav>
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
  
 