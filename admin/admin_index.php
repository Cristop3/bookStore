<?php
    /**
     *   管理员需要优化的地方：
     *       1.首先这个后台页面就不合格 没按照传统的那种框架来做，不过不急 这只是练手php
     *
     *
     */
    include "../config.inc.php";
    include "../db.inc.php";

    //echo "这里是管理员界面";
?>
<html>
    <head>
        <meta charset='utf-8'>
        <title>管理员主页</title>
        <link rel='styleSheet' href='../style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='../style/config.inc.css' />
       
        <style>
            .header{width:1194px;height:60px;background-color:#0f8bee;margin:0 auto;text-align:center;padding-top:1px;}
            .header h1{color:yellow;}
            .box{width:1190px;height:500px;margin:0 auto;position:relative;}
            .ad_nav{width:500px;height:300px;//border:1px solid blue;position:absolute;top:100px;left:350px;text-align:center;}
            .div_form{width:500px;height:200px;background-color:blue;}
        </style>
    </head>

    <body>
        <div class='header'>
            <h1>Caristop3后台管理</h1>
        </div>
        <div class='box'>
            <img src='../images/ad_index.png' height="500" width="1190" />
            <div class='ad_nav'>
                <a href='addBook.php' class='btn btn-primary btn-lg'>添加图书商品</a>
                <a href='listBook.php' class='btn btn-info btn-lg'>修改图书商品</a>
                <a href='listBook.php' class='btn btn-success btn-lg'>删除图书商品</a>
            </div>
        </div>
    </body>
</html>
 
