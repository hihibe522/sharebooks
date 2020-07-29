<?php require_once 'config.php' ;?>
<?php include_once 'header.php' ;?>


<link rel="stylesheet" href="css/main_member.css">
<link rel="stylesheet" href="css/stocks.css">
        

<!-- navbar引用 -->
<?php include_once 'navbar.php' ;

if(!isset($_SESSION["userID"]) && @$_SESSION["userID"]==""){
    echo " <script> loginBoxIn(); </script>";
    echo "請先進行登入";
    exit();
}

?>  
    <h1>整理交換書單
        <select name="changeProject" id="selectPj">
            <option value="all" selected>全部</option>
            <option value="receive">收到的邀請</option>
            <option value="send">送出的邀請</option>
        </select>
    </h1>
    <div class="hr_line"></div>
    <!-- content -->
    <main class="container"></main>

<!--詳細處理中 交換書單  -->
    <div class="projectArea"></div>
<?php include_once 'footer_info.php'; ?>
 
<script>
    var myID = <?= $_SESSION["userID"] ?> ;
    $(document).ready(getmyproject("all"));

    function getmyproject(selPj){
        $.ajax({
        type :"POST",
        // async:false,
        data: { search :selPj },
        url  : "book_stor_aj.php",
        success : view
        });
    }
    $('#selectPj').on('change',changeSearch);

    function changeSearch(){
        selPj = $(this).val();
        $.ajax({
        type :"POST",
        data: { search :selPj },
        url  : "book_stor_aj.php",
        success : view
        });

    }

    function view(e) {
        console.log(e);
        var data = JSON.parse(e);
        console.log(data);
        $('.container').html('');
        var projectStr= "";
        data.forEach(function(item,index) {
                // console.log(item.user);
        projectStr += ` <section class="project" data-project ="${item.orderID}">
            <div class="mybook">
                <h3>${item.userName}的書</h3>
                <div class="book_card" data-user="${item.user}">
                    <div class="myImg"><img src="${item.userbookImg}" alt="..."></div>
                    <div class="card_Title">
                        <p><span>書名</span>${item.userbookName}</p>
                    </div>
                </div>
            </div>
            <div class="i_con">
                <i class="fa fa-mail-forward"></i>
            </div>
            <div class="pasbook">
                <h3>${item.pasuserName}的書</h3>
                <div class="book_card o_card" data-user="${item.pasuser}">
                    <div class="myImg"><img src="${item.pasbookImg}" alt="..."></div>
                    <div class="card_Title">
                        <p><span>書名</span>${item.pasbookName}</p>     
                    </div>
                </div>
            </div>
            <div class="status">
                <p>接洽中</p>
                <p class="sTime">${item.updatetime}</p>
                <button class="btn btn_green checkBtn" data-toggle="modal" data-target="#send_modal">查看</button>
            </div>
        </section>`
        })
        $('.container').html(projectStr);
        var bookcardList = $('.book_card');
        let cardListarray = Object.values(bookcardList)
        // console.log(cardListarray);
        cardListarray.forEach(function(item,index, array){
            var ownerId = item.getAttribute('data-user');
              if(ownerId==myID){
                  item.classList.add("m_card");
              }
        })
       
    }

// 查看詳細資料
$(document).on('click','.checkBtn',checkdetail);

    function checkdetail(){
        $(".projectBox").remove();
        $('.modal-backdrop').remove();
        var project =  $(this).parents("section");
        projectID = project.attr("data-project");
        $.ajax({
                type:"post",
                data:{project:projectID},
                url:"book_stor_aj.php",
                success:function(e){
                    var data = JSON.parse(e);
                    console.log(data);
                    var projectStr = "";
                    projectStr =`<div class="modal fade" id="send_modal" tabindex="-1" role="dialog" aria-labelledby="closeIt" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                    <div class="send_card">
                    <h3>${data.type}<div class="list_close" data-dismiss="modal"><i class="fa fa-close"></i></div></h3>
                        <div class="card_main">
                            <div class="card_img">
                                <img src="${data.detail.bookImg}" alt="">
                            </div>
                            <div class="card_body">
                                <div><span>書名</span><p>${data.detail.bookName}</p></div>
                                <div><span>作者</span><p>${data.detail.author}</p></div>
                                <div><span>書況</span><p>${data.detail.bookStatus}</p></div>
                                <div><span>想要的書</span><p>${data.detail.wanted}</p></div>
                                <div><span>所在地點</span><p>${data.detail.place}</p></div>
                                <div><span>書主</span><p>${data.detail.userName}</p></div>
                                <div><span>上傳時間</span><p>${data.detail.updateTime}</p></div>            
                            </div>
                        </div>      
                            <div class="text_content">
                                <div class="msg">
                                </div>
                                <form method="post" action="book_stor_aj.php">
                                    <input type="hidden" name="projectID" value="${projectID}">
                                    <input class="form-control omsg" name="newMsg" type="text" placeholder="要給對方的訊息~" required >
                                    <button class="btn btn_blue" name="sendMsg" type="submit">send</button>
                                </form>
                                <form method="post" action="book_stor_aj.php">
                                    <input type="hidden" name="projectID" value="${projectID}">
                                    <div class="projectBtn"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>` ;
                // console.log(projectID);
                $('.projectArea').after('<section class="projectBox"></section>');
                $(".projectBox").append(projectStr);
                if(myID == data.order.user){
                    projectBtnStr= `<button class="btn btn_red" name="cancleBtn" type="submit" >取消邀請</button>`;
                }
                else{
                    projectBtnStr =`<button class="btn btn_yellow" name="agreeBtn" type="submit">同意邀請</button>
                                        <button class="btn btn_red" name="denyBtn" type="submit">拒絕邀請</button>`;
                }
                $('.projectBtn').append(projectBtnStr);
                var msg = data.msg;
                // console.log(msg);
                msg = msg.split('X@@X');
                msg.pop();
                msgStr= "";
                msg.forEach(function(item,index){
                    msgStr += `<p>${item}</p>`;
                })
                $('.msg').empty();
                $('.msg').append(msgStr);
                // console.log(msg);
                $('#send_modal').modal('show');




                }
        })

    }

    
    
</script>
<script src="js/coreFn.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php include_once 'footer.php'; ?>