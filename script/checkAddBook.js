/**
 *  关于添加图书中的规则验证
 * 
 */

$(function(){

        //bookISBN的检验
        var reg_ISBN = /^[1-9]\d{9}/;
        $(".td2 input[name='bookISBN']").blur(function(){
            if(reg_ISBN.test($(this).val())){
                $(".showMes img[value='bookISBN']").attr('src','../images/right.png').show();
                $("div[value='bookISBN']").hide();
            }else{
                $(".showMes img[value='bookISBN']").attr('src','../images/error.png').show();
                $("div[value='bookISBN']").html("ISBN必须为非零开始的10位数字").show();
            }
        });

        //bookName的检验
        $(".td2 input[name='bookName']").blur(function(){
            if($(this).val() != ""){
                $(".showMes img[value='bookName']").attr('src','../images/right.png').show();
                $("div[value='bookName']").hide();
            }else{
                $(".showMes img[value='bookName']").attr('src','../images/error.png').show();
                $("div[value='bookName']").html("书名非空!!!").show();
                $(this).focus();
            }       
        });

        //bookAuthor的检验
        $(".td2 input[name='bookAuthor']").blur(function(){
            if($(this).val() != ""){
                $(".showMes img[value='bookAuthor']").attr('src','../images/right.png').show();
                $("div[value='bookAuthor']").hide();
            }else{
                $(".showMes img[value='bookAuthor']").attr('src','../images/error.png').show();
                $("div[value='bookAuthor']").html("作者名非空!!!").show();
                $(this).focus();
            }
        });

        //bookPrice的检验
        $(".td2 input[name='bookPrice']").blur(function(){
            if($(this).val() != ""){
                $(".showMes img[value='bookPrice']").attr('src','../images/right.png').show();
                $("div[value='bookPrice']").hide();
            }else{
                $(".showMes img[value='bookPrice']").attr('src','../images/error.png').show();
                $("div[value='bookPrice']").html("请输入价格哟!!!").show();
                $(this).focus();
            }
        });
        
        //bookPublish的检验
        $(".td2 input[name='bookPublish']").blur(function(){
            if($(this).val() != ""){
                $(".showMes img[value='bookPublish']").attr('src','../images/right.png').show();
                $("div[value='bookPublish']").hide();
            }else{
                $(".showMes img[value='bookPublish']").attr('src','../images/error.png').show();
                $("div[value='bookPublish']").html("出版社非空!!!").show();
                $(this).focus();
            }
        });
        
        //bookPic的检验
        $(".td2 input[name='bookPic']").blur(function(){
            if($(this).val() != ""){
                $(".showMes img[value='bookPic']").attr('src','../images/right.png').show();
                $("div[value='bookPic']").hide();
            }else{
                $(".showMes img[value='bookPic']").attr('src','../images/error.png').show();
                $("div[value='bookPic']").html("请上传图书封面!!!").show();
                $(this).focus();
            }
        });
        
        //bookAbstract的检验
        $(" textarea[name='bookAbstract']").blur(function(){
            if($(this).val() != ""){
                $(".showMes img[value='bookAbstract']").attr('src','../images/right.png').show();
                $("div[value='bookAbstract']").hide();
            }else{
                $(".showMes img[value='bookAbstract']").attr('src','../images/error.png').show();
                $("div[value='bookAbstract']").html("图书详情非空!!!").show();
                $(this).focus();
            }
        });
        /*
        function check(obj,attrr){
            //alert(attrr);
            alert(obj)
            if(obj.val() != ""){
                alert(1)   
                $(".showMes img[value=attrr]").attr('src','../images/right.png').show();
                $("div[value=attrr]").hide();
            }else{
                $(".showMes img[value=attrr]").attr('src','../images/error.png').show();
                $("div[value=attrr]").html("出版社非空!!!").show();
                obj.focus();
            }
        }*/
        
    
});