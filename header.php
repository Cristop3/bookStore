<?php
    /**
     *  这里需要优化的地方：
     *      1.获取头像最好使用ajax来 不然你修改资料的时候改变了session 那么头像显示失败
     *
     * 
     */
    if(isset($_SESSION['username'])){
       $username = $_SESSION['username'];
       $pic = "th_".$_SESSION['pic']; 
    }else{
        $username = '游客.'."<a href='login.php'>请登录</a>";
        $pic = "visitor.png";
    } 
?>
<html>
    <head>
        <meta charset='utf-8'>
        <title>网上书城主页</title>
        <link rel='styleSheet' href='style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='style/config.inc.css'/>
        <link rel='styleSheet' href='style/index.css' />
        <script type='text/javascript' src='script/jquery-1.11.3.min.js'></script>
        
    </head>
    <body>
        <div class='nav_top'>
            <p class='top_login_info'>
                <img class='info_span1 img-circle' src="uploads/<?php echo $pic; ?>" />
                <span class='info_span2'>Hi!</span>
                <span class='info_span2'><a href='#'><?php echo $username; ?></a></span>
                <span class='info_span2'><a href='logout.php'>退出</a></span>
            </p>
            <ul class='top_right_info'>
                <li class='btn btn-info'><a href='modify.php'>修改资料</a></li>
                <li class='btn btn-info'><a href='#'>我的订单</a></li>
                <li class='btn btn-info'><a href='cart.php'>购物车</a></li>
                <li class='btn btn-info'><a href='showSelf.php'>查看自己</a></li>    
            </ul>
        </div>