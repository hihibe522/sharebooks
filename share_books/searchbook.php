<?php require_once 'config.php' ;?>
<?php include_once 'header.php' ;?>

<link rel="stylesheet" href="css/searchbook.css">
<?php     
    include_once 'navbar.php';
    
    if(isset($_GET["cha"]) && $_GET["cha"]=="ok" ){
    echo "<script> alert('邀請已送出，請到 接洽中書單查詢')</script>";
    }
?>
<!-- search Book content  -->
    <div class="container">
<!--header 搜尋欄 -->
    <header class="row no-gutters">
        <div class="myselect col-sm-6 col-md-4">
            <span>時間排序</span> 
            <select name=setTime id="setTime">
                <option value="new">最新</option>
                <option value="old">最舊</option>
            </select>
        </div>
        <div class="myselect col-sm-6 col-md-4">
            <span>地區</span> 
            <select name="area" id="area">
                <option value="全部">全部</option>
                <option value="北部">北部</option>
                <option value="中部">中部</option>
                <option value="南部">南部</option>
                <option value="外島其他">外島其他</option>
            </select>
        </div>
        <div class="col-sm-6 col-md-4">       
                <input class="form-control mysearch" type="search" placeholder="請輸入書名或作者" aria-label="Search">
                <button class="btn btn_blue searchBtn">搜尋</button>       
        </div>
    </header>
<!-- bookcard欄  -->
    <section class="row"></section>   
    </div>

<!-- click後 bookcard 詳細內容 -->
    <div class="addele"></div><section class="bookList"></section>

<!-- click 我要交換內容 -->
    <div class="changele"></div><section class="changeBoxArea"></section>

<!-- <div class="page">
    <ul>
        <li>1</li>
        <li>2</li>
        <li>3</li>
        <li>4</li>
    </ul>
</div> -->

<?php include_once 'footer_info.php'; ?>
<script>
var login = location.search;
if(login == "?lgB=1"){
    loginBoxIn();
    setTimeout(() => {
        location.href = location.href.substring(0, location.href.indexOf("?"));
    },2000);
   
}

$(".searchBtn").on('click',searchbook);

function searchbook(){
    var mysearch = $('.mysearch').val();
    $.ajax({
        type :"POST",
        data: { mysearch : mysearch },
        url  : "serch_aj.php",
        success : function(e){
            var data = JSON.parse(e);
            searchBooksView(data);
        }
    });
}

//初始畫面顯示全部
    var data = getAllBooks();
    $(document).ready(getAllBooks);
    searchBooksView(data);
    console.log(data);


//書本List的顯示
function searchBooksView(data) { 
    $('section.row').html(''); 
    let str = "";
    data.forEach(function(item,index) {
        str += `<div class="book_card col-sm-12 col-md-4" data-bookID="${item.bookID}" data-toggle="modal" data-target="#card_d">
                <div class="card_Title">
                    <div class=""><img src="${item.bookImg}" alt="..."></div>
                </div>
                <div class="card_Title c_right">
                            <p><span>書名 </span>${item.bookName}</p>
                            <p><span>作者 </span>${item.author}</p>
                            <div class="card_Title_s">   
                                <p>${item.userName}</p>
                                <p>更新 ${item.updateTime}</p>
                            </div>
                        </div>          
                </div>`
            })
            $('section.row').html(str);  
}
// #click (book_card) then (book_detail) appear
    $(document).on('click','.book_card',getBookDetail);
function getBookDetail(e){  
    $('.modal-backdrop').remove(); 
    $('section.bookList').remove();    
    var focusBID = $(this).attr("data-bookID");
    var bookstr = "";
    var fData =  data.filter(function(item,index){
        return item.bookID == focusBID;
    });
    bookstr =`<div class="modal fade" id="card_d" tabindex="-1" role="dialog" aria-labelledby="closeIt" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="card_detail row">
                <div class="icon_close" data-dismiss="modal"><i class="fa fa-close"></i></div>  
                <div class="card_img col-sm-12 col-md-5">
                    <img src="${fData[0].bookImg}" alt="">
                    <button class="btn goChange btn_green" data-toggle="modal" data-target="#card_c" data-bookID="${fData[0].bookID}"data-userID ="${fData[0].userID}" >我要交換</button>
                </div>
                <div class="card_main col-sm-12 col-md-6">
                    <div><span>書名</span><p>${fData[0].bookName}</p></div>
                    <div><span>作者</span><p>${fData[0].author}</p></div>
                    <div><span>類型</span><p>${fData[0].bookType}</p></div>
                    <div><span>書況</span><p>${fData[0].bookStatus}</p></div>
                    <div><span>想要的書</span><p>${fData[0].wanted}</p></div>
                    <div><span>所在地點</span><p>${fData[0].place}</p></div>
                    <div><span>書主</span><p>${fData[0].userName}</p></div>
                    <div><span>上傳時間</span><p>${fData[0].updateTime}</p></div>          
                               
                </div>
            </div>
        </div>          
    </div>`;
    $('.addele').after("<section class='bookList'></section>");
    $('section.bookList').html(bookstr);

    }

// bookList 條件篩選
$('#setTime,#area').on('change',changeCondition);
function changeCondition(){
        var time = $('#setTime').val();
        var area = $('#area').val();
        console.log(time,area);
        var ndata = data;
        if(area != "全部"){
             ndata = data.filter(function(item,index){
                return item.place == area;
            })  
        }        
        if(time == "old"){      
            // console.log(data);
            ndata = ndata.sort(function(a, b) {
                return b.updateTime < a.updateTime ? 1 : -1; //由最早排序
            });
        }
        if(time =="new"){
            ndata = ndata.sort(function(a,b){
            return a.updateTime < b.updateTime ? 1 : -1; //由新到舊
            })
        }
        searchBooksView(ndata);
    }

    //完成交換後關閉視窗
    $('#okchange').on('click',function(){
        $('.modal').modal('dispose');
    })

//ajax 取出全部書單
function getAllBooks(){
    var dataOut = [];
    $.ajax({
        type :"POST",
        async:false,
        data: { search : "all" },
        url  : "serch_aj.php",
        success : function(e){
            var data = JSON.parse(e);
            dataOut = data;
        }
    });
    return dataOut ;
}

$(document).on('click','.goChange',Gochange);
function Gochange(){
    // click "我要交換"後 關閉book_detail視窗
    $('#card_d').modal('hide');
    $(".changeBoxArea").remove();
    $('.modal-backdrop').remove();
    var bookID = $(this).attr("data-bookID");
    var userID = $(this).attr("data-userID");

    $.ajax({
        type :"POST",
        data:{ change : bookID,
               bookOwner: userID
            },
        url  : "serch_aj.php",
        success : function(e){
            // console.log(e);
            var res = e.trim();
            console.log(res);
            if( res == "xxx"){
                alert("請先進行登入");          
            }
            if(res == "self"){
                alert("這是你自己的書唷~");
            }
            else{
                var mydata = JSON.parse(res);
                console.log(mydata);
                var changeBoxStr = "";
                changeBoxStr=`<div class="modal fade" id="card_c" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="post" action="serch_aj.php" name="changeform" onsubmit="return chk();">
                                <div class="row card_detail changeBox">      
                                    <div class="col-sm-12 col-md-6">
                                        <h1>我的書單</h1>
                                        <div class="mybookList">                 
                                        </div>                  
                                    </div>
                                    <div class="col-sm-12 col-md-6 textIn">
                                        <h1>詢問與備註</h1>   
                                        <input type="hidden" name="pasuser" value="${userID}">
                                        <input type="hidden" name="pasbook" value="${bookID}">
                                        <input type="text" name="ordermsg" class="form-control" placeholder="要給對方的訊息~">
                                        <div class="btnGroup">     
                                            <button class="btn cancel_change" data-dismiss="modal">取消</button>
                                            <button type="submit" name="changebtn" id="okchange" class="btn btn_green">邀請交換</button>            
                                        </div>              
                                    </div>            
                                </div>
                            </form>
                        </div>
                    </div>` ;
                    var mybookListStr ="";
                    if(mydata.length == 0){
                        mybookListStr=`<div class="tobook">您目前沒有可交換的書本<br>請先至書本管理上傳登錄</div>`;
                       
                    }else{
                        mydata.forEach(function(item, index, array){
                            mybookListStr += `<label for="${item.bookID}"><input type="radio" name="mybook" id="${item.bookID}" value="${item.bookID}">${item.bookName}</label>`;// forEach 就如同 for，不過寫法更容易
                        });
                    }
                    $('.changele').after('<section class="changeBoxArea"></section>');
                    $(".changeBoxArea").append(changeBoxStr);
                    if(mydata.length == 0){
                        var changeBtnarea =`<div class="btnGroup">     
                                            <button class="btn cancel_change" data-dismiss="modal">取消</button>
                                            <button onclick="toAdd();" class="btn btn_green">上傳書本</button>            
                                            </div>`;
                        $(".textIn").html(changeBtnarea);
                    }                 
                    $(".mybookList").empty();
                    $(".mybookList").append(mybookListStr);
                    $('#card_c').modal('show');
            }

        }
    });
}
//換書前進行判斷有沒有選書或留言
function chk(){
    if(document.changeform.mybook.checked ==''){
      alert('請選一本書');
      return false;
    }
    if(document.changeform.ordermsg.value==''){
      alert('留個言吧 : )');
      return false;
    }
    return true;

}

function toAdd(){
    document.changeform.action='book_add.php';
    document.changeform.submit();
}
                       
</script>
<?php include_once 'footer.php'; ?>
