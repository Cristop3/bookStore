$(function(){

    //用户名的ajax检验
    var regUser = /[a-zA-Z0-9_]{4,10}/;
    $(".td2 input[name='username']").keydown(function(){
         $(".showMes img[value='username']").attr('src','images/arrows.png').show();
        }).blur(function(){
            var _this = $(this);
            var user = $.trim(_this.val());
            checkUrl = "registerAjax.php?username="+user;
            $.get(checkUrl,function(resText){
                if(resText==1){
                    $("#username").html("该用户名已经存在请重新输入").show();
                    $(".showMes img[value='username']").attr('src','images/error.png').show();
                }else{
                    $("#username").html("可以注册").show();
                    $(".showMes img[value='username']").attr('src','images/right.png').show();
                    if(regUser.test(_this.val())){
                        $("#username").hide();
                    }else{
                      $(".showMes img[value='username']").attr('src','images/error.png').show();
                      setTimeout(function(){
                        $("#username").html("注意必须是字母或_个数4-10")
                    },500);
                    } 
                }
        });
    })

    //密码检验
    var regPass = /[a-zA-Z0-9]{6,10}/;
    $(".td2 input[name='password']").blur(function(){
        if(regPass.test($(this).val())){
            $(".showMes img[value='password']").attr('src','images/right.png').show();
            $("div[value='password']").hide();
        }else{
            $(".showMes img[value='password']").attr('src','images/error.png').show();
            $("div[value='password']").show();
        }
    });

    //电话检验
    var regTel = /[0-9]{11}/;
    $(".td2 input[name='phone']").blur(function(){
        if(regTel.test($(this).val())){
            $(".showMes img[value='phone']").attr('src','images/right.png').show();
            $("div[value='phone']").hide();
        }else{
            $(".showMes img[value='phone']").attr('src','images/error.png').show();
            $("div[value='phone']").show();
        }
    });

    //email检验
    var regEma = /^\w+@[a-z0-9]+\.[a-z]{2,4}$/;
    $(".td2 input[name='email']").blur(function(){
        if(regEma.test($(this).val())){
            $(".showMes img[value='email']").attr('src','images/right.png').show();
            $("div[value='email']").hide();
        }else{
            $(".showMes img[value='email']").attr('src','images/error.png').show();
            $("div[value='email']").show();
        }
    });
});