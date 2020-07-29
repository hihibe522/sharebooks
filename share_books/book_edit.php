<?php require_once 'config.php' ;?>
<?php include_once 'header.php' ;?>

<link rel="stylesheet" href="css/main_member.css">
<link rel="stylesheet" href="css/editBook.css">

<?php
    //navbar引用
    include_once 'navbar.php' ;

    if(!isset($_SESSION["userID"]) && @$_SESSION["userID"]==""){
        echo " <script> loginBoxIn(); </script>";
        echo "請先進行登入";
        exit();
    }
    
?>
<div aria-live="polite" aria-atomic="true">
    <div id="ttt" class="toast" role="alert"  data-delay="700" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">ShareBooks</strong>
    </div>
    <div class="toast-body">書本資料更新成功!!</div>
    </div>
</div>
<div aria-live="polite" aria-atomic="true">
    <div id="aaa" class="toast" role="alert"  data-delay="700" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">ShareBooks</strong>
    </div>
    <div class="toast-body">書本上傳成功!!</div>
    </div>
</div>
<div aria-live="polite" aria-atomic="true">
    <div id="ddd" class="toast" role="alert"  data-delay="700" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <strong class="mr-auto">ShareBooks</strong>
    </div>
    <div class="toast-body">書本已刪除!!</div>
    </div>
</div>

<!-- content -->   
<h1>整理你的書本<button class="btn btn_yellow btn_plus" onclick="location.href='book_add.php'" ><i class="fa fa-plus"></i></button></h1>
<div class="hr_line"></div>
    <button class="btn btn_yellow btn_circle" onclick="location.href='book_add.php'"><i class="fa fa-plus"></i></button>
    <div class="container">
        <section class="row"></section>
    </div>

<!--form model -->
<div class="addele"></div><section class="bookList">

<div class="deletBox"></div>

<?php include_once 'footer_info.php'; ?>

<script>
var data = yourBooks();
    $(document).ready(yourBooks);
    myBooksView(data);

//取得你的書本ajax    
function yourBooks(){
    var dataOut = [];
    $.ajax({
        type :"GET",
        async:false,
        data:{ mybook : "all" },
        url  : "book_edit_aj.php",
        success : function(e){
            var data = JSON.parse(e);
            //  console.log(data);
            dataOut = data;
        }
    });
    return dataOut ;
}

function myBooksView(data) { 
    $('section.row').html(''); 
    let str = "";
    data.forEach(function(item,index) {
        str += `<div class="book_card col-sm-12 col-md-5">
                    <div class="card_Title">
                        <div class=""><img src="${item.bookImg}" alt="..."></div>
                    </div>
                    <div>
                        <div class="card_Title">
                            <p><span>書名</span>${item.bookName}</p>
                            <p><span>作者</span>${item.author}</p>
                        </div>
                    </div>
                    <div>
                        <span class="b_icon editBooks" data-bookID="${item.bookID}" data-toggle="modal" data-target="#edit_b"><i class="fa fa-book"></i></span>
                        <span class="b_icon delectBook"data-bookID="${item.bookID}"><i class="fa fa-trash"></i></span>
                    </div> 
                </div>`
            })
            $('section.row').html(str);
            dataOut = data;
    
}

//刪除書本
$(document).on('click','.delectBook',delectBook);

function delectBook(){

    var checkdel=confirm("確定要刪除嗎");
    if(checkdel){
    var bookID =  $(this).attr("data-bookID");
    $.ajax({
        type :"POST",
        data:{ delect : bookID },
        url  : "book_edit_aj.php",
        success : function(e){
            if(e){
                $('#ddd').toast('show');
                setTimeout('location.reload()',1000);
            }
        }
        });
    }

}

//詳細修改內容
$(document).on('click','.editBooks',editBookDetail);
var edit = location.search;

    switch(edit){

        case "?edit=eok":
            $('#ttt').toast('show');
            break;

        case "?up=uok":
            $('#aaa').toast('show');
            break;

            default:
            console.log("error");
    }
   
function editBookDetail(e){  
    $('.modal-backdrop').remove();
    $('section.bookList').remove();    
    var focusBID = $(this).attr("data-bookID");
    var bookstr = "";
    var fData =  data.filter(function(item,index){
        return item.bookID == focusBID;
    });
    bookstr =`<div class="modal fade" id="edit_b" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="edit_form">
        <form method="post" enctype="multipart/form-data" action="book_edit_aj.php" class="col-sm-12 col-md-8">
        <input type="hidden" name="bookID" value="${fData[0].bookID}">
            <div class="form-group">
            <label for="booKImg">上傳書的圖檔</label>
            <img id="preview_b_img" src="${fData[0].bookImg}"/>
            </div>  
            <div class="form-group">
                <label for="bookName">書名</label>
                <input type="text" name="bookName" class="form-control" id="bookName" value="${fData[0].bookName}">
            </div>
            <div class="form-group">
                <label for="author">作者</label>
                <input type="text" name="author" class="form-control" id="author" value="${fData[0].author}">
            </div>
            <div class="form-group">
                <label for="bookType">類型</label>
                <input type="text" name="bookType" class="form-control" id="bookType" value="${fData[0].bookType}">
            </div>
            <div class="form-group">
                <label for="bookStatus">書況</label>
                <input type="text" name="bookStatus" class="form-control" id="bookStatus" value="${fData[0].bookStatus}">
            </div>
            <div class="form-group">
                <label for="wanted">想要的書</label>
                <input type="text" name="wanted" class="form-control" id="wanted" value="${fData[0].wanted}">
            </div>       
            <div class="form-group">
                <label for="place">所在地區</label>
                <select name="place" class="form-control" id="place">
                    <option value="北部" ${(fData[0].place=="北部")? "selected" : ""}>北部</option>
                    <option value="中部" ${(fData[0].place=="中部")? "selected" : ""}>中部</option>
                    <option value="南部" ${(fData[0].place=="南部")? "selected" : ""}>南部</option>
                    <option value="外島其他" ${(fData[0].place=="外島其他")?"selected" : ""}>外島其他</option>
                </select>
            </div>          
            <button type="submit" name="OKbtn" class="btn btn_blue">Submit</button>
        </form>
        </div>
        </div>
    </div>`;

    $('.addele').after("<section class='bookList'></section>");
    $('section.bookList').html(bookstr);

}



</script>

<?php include_once 'footer.php'; ?>
