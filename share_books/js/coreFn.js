//navbar 所在位置 標籤樣式
window.onload = navbar_active;

function navbar_active() {
    // alert("133");
    var pathname = location.pathname;//找到這個頁面的路徑
    
    $('.navbar-nav li a').each(function(){ //取所有a標簽
        var href = $(this).attr('href');   //獲取連接地址
        // console.log(href);
        // console.log(pathname);
        if(pathname.indexOf(href) != -1 ){  //check是不是包含當前頁的路徑
            $('.navbar-nav li a').removeClass('active');//有的話先把.active全部去掉
            $(this).addClass('active');//再給這個加上active            
        }      
    })
    //LoginBox click
    $("#user_Login").on('click',loginBoxIn);
    $('.icon_close').on('click',loginBoxOut);
      
};

function loginBoxIn(){
    $('.loginBox').fadeIn(300);
    return false;
}
function loginBoxOut(){
    $('.loginBox').fadeOut(300);
}


