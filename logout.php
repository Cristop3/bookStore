<?php
    include "config.inc.php";

    $username = $_SESSION['username']; //在session中获取用户名

    $_SESSION = [];

    if(isset($_COOKIE[session_name()])){
        setCookie(session_name(),"",time()-3600);
    }

    session_destroy();

    echo "再见!".$username;

    echo "<script>
        setTimeout(function(){
            window.location = 'login.php';
        },1000);
    </script>"
?>