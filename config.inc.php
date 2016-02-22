<?php
    header('Content-type:text/html; charset=utf-8');
    session_start();//开启session会话

    date_default_timezone_set("PRC");
    error_reporting("E_ALL & ~E_NOTICE");

    define("DSN","mysql:host=localhost;dbname=bookstore");
    define("DBUSER","root");
    define("DBPASS","");

    //假设一个全局变量来判断插入是否有变化
    //$isChangeID = "1";
?>