<?php require_once 'config.php' ;?>
<?php include_once 'header.php' ;?>



<link rel="stylesheet" href="css/main_member.css">
<!-- navbar引用 -->
<?php include_once 'navbar.php' ;?>

<?php
if(isset($_POST["OKbtn"])){
  global $db;
  processFile ( $_FILES ["booKImg"] );
  $imgStr ="images/".$_FILES ["booKImg"]["name"];
  $bsql ="insert into bookinfo
  (bookName,author,bookType,bookStatus,wanted,place,userID,bookImg,updateTime,unable)
  values
  (:bookName,:author,:bookType,:bookStatus,:wanted,:place,:userID,:bookImg,:updateTime,1)";
  $query = $db->prepare($bsql);
  $query->bindValue(":bookName",$_POST["bookName"], PDO::PARAM_STR);
  $query->bindValue(":author",$_POST["author"], PDO::PARAM_STR);
  $query->bindValue(":bookType",$_POST["bookType"], PDO::PARAM_STR);
  $query->bindValue(":bookStatus",$_POST["bookStatus"], PDO::PARAM_STR);
  $query->bindValue(":wanted",$_POST["wanted"], PDO::PARAM_STR);
  $query->bindValue(":place",$_POST["place"], PDO::PARAM_STR);
  $query->bindValue(":userID",$_SESSION["userID"], PDO::PARAM_INT);
  $query->bindValue(":bookImg",$imgStr, PDO::PARAM_STR);
  $query->bindValue(":updateTime",date("Y-m-d") , PDO::PARAM_STR);
  $query->execute();
  header("location:book_edit.php?up=uok");

}

function processFile($objFile) {
	if ($objFile ["error"] != 0) {
		echo "Upload Fail! ";
		return;
  }
  
    $upImg = move_uploaded_file ( $objFile ["tmp_name"] , "./images/" . $objFile ["name"] ); 
    if (! $upImg) {
    	die ( "move_uploaded_file() faile" );
    }
}
?>
   
    <h1>上傳你的書單</h1>
    <div class="hr_line"></div>
    <hr>
    <!-- form content -->
  <section class="container">
      <form method="post" enctype="multipart/form-data" action="" class="col-sm-12 col-md-8">
      <input type="hidden" name="userID">
        <div class="form-group">
          <label for="booKImg">上傳書的圖檔</label>
          <input type="file" id="booKImg" name="booKImg" accept="image/gif, image/jpeg, image/png" required >
          <img id="preview_b_img" src="#"/>
        </div>  
        <div class="form-group">
              <label for="bookName">書名</label>
              <input type="text" name="bookName" class="form-control" id="bookName" placeholder="請輸入書名" required>
          </div>
          <div class="form-group">
              <label for="author">作者</label>
              <input type="text" name="author" class="form-control" id="author" placeholder="作者或出版社" required>
          </div>
          <div class="form-group">
              <label for="bookType">類型</label>
              <input type="text" name="bookType" class="form-control" id="bookType" placeholder="請輸入書的類型" required>
          </div>
          <div class="form-group">
              <label for="bookStatus">書況</label>
              <input type="text" name="bookStatus" class="form-control" id="bookStatus" placeholder="備註" required>
          </div>
          <div class="form-group">
              <label for="wanted">想要的書</label>
              <input type="text" name="wanted" class="form-control" id="wanted" placeholder="想換得類型或書名" required>
          </div>       
          <div class="form-group">
            <label for="place">所在地區</label>
            <select name="place" class="form-control" id="place">
                  <option value="北部">北部</option>
                  <option value="中部">中部</option>
                  <option value="南部">南部</option>
                  <option value="外島其他">外島其他</option>
              </select>
          </div>          
          <button type="submit" name="OKbtn" class="btn btn_blue">Submit</button>
        </form>
  </section>
<?php include_once 'footer_info.php'; ?>
<script>
  // 上傳圖片預覽
    $("#booKImg").change(function(){
      readURL(this);
    });

  function readURL(input){
    if(input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#preview_b_img").attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    }else{
      $("#preview_b_img").attr('src','');
    }
  }
  </script>
<?php include_once 'footer.php'; ?>