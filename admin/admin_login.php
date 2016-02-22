<?php
    
?>

<html>
    <head>
        <meta charset='utf-8'>
        <title>Caristop3-BookStore后台管理</title>
        <link rel='styleSheet' href='../style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='../style/config.inc.css' />
        <link rel='styleSheet' href='../style/layout_login.css'/>
       <script> /*
            function checkForm(){
                var oUser= document.getElementById('user');
                var oPass = document.getElementById('pass');
                if(oUser.value==''&&oPass.value==''){
                    alert('请填写你的登录信息');
                    oUser.focus();
                    return false;
                } 
                if(oUser.value==''){
                    alert("请填写用户名!!");
                    oUser.focus();
                    return false;
                }
                if(oPass.value==''){
                    alert("请填写密码!!");
                    oPass.focus();
                    return false;
                }
            }*/
        </script>
    </head>
    <body>
        <div class='box'>
            <div class='login_head'>
                <a href='#' class='loginA'>BookStore后台管理</a>
            </div>
            <div class='login_cont'>
                <div class='inner'>
                    <img src='../images/register.png' height="600" width="1190" />
                </div>
                <div class='login_form'>
                    <div class='panel panel-success loginPanel'>
                        <div class='panel panel-heading'>
                            <div class='panel-title'>
                                <h3>管理员登录</h3>
                            </div>
                        </div>
                        <div class='panel-body'>
                            <div class='container'>
                                <form role='form' class='form-inline'  action='admin_index.php' method='post' onsubmit="return checkForm()">
                                 
                                    <lable><div class='glyphicon glyphicon-user tbUser'></div></lable>
                                    <input id='user' type='text' class='form-control input-lg inpUser' value='' name='username' placeholder='手机号/会员名/邮箱' autofocus><br><br>
                                    <lable><div class='glyphicon glyphicon-lock tbUser'></div></lable>
                                    <input id='pass' value='' type='password' class='form-control input-lg inpUser' name='password'><br><br>

                                    <input  class='btn btn-success btnSub' type='submit' name='dosubmit' value='登录' />
                                </form>
                                <div class='contA'>
                                    <a href='findPass.php'>忘记密码</a>
                                    <a href='register.php'>免费注册</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>