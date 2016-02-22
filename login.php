<?php
    include "config.inc.php";
    include "db.inc.php";

    //处理登录
    if(isset($_POST['dosubmit'])){
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        try{

            $sql="select userID,username,password,email,phone,pic,address from user where username=? and password=?";
            
            $stmt = $pdo->prepare($sql);

            $stmt->execute(array("{$username}","{$password}"));

            //若在数据库中查到数据
            if($stmt->rowCount()>0){

               $_SESSION = $stmt->fetch(PDO::FETCH_ASSOC);//将所有数据给session

                //并跳转到主页
                echo "<script>setTimeout(function(){
                    window.location = 'index.php';
                },1000)</script>";

            }else{
                echo "登录失败";
                exit;
            }
        }catch(PDOException $e){
            echo "ERROR:".$e->getMessage();
        }
    }

?>

<html>
    <head>
        <meta charset='utf-8'>
        <title>上Caristop3-BookStore就够了</title>
        <link rel='styleSheet' href='style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='style/config.inc.css' />
        <link rel='styleSheet' href='style/layout_login.css'/>
       <script> 
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
            }
        </script>
    </head>
    <body>
        <div class='box'>
            <div class='login_head'>
                <a href='index.php' class='loginA'>Caristop3-BookStore</a>
            </div>
            <div class='login_cont'>
                <div class='inner'>
                    <img src='images/login.png' height="600" width="1190" />
                </div>
                <div class='login_form'>
                    <div class='panel panel-primary loginPanel'>
                        <div class='panel panel-heading'>
                            <div class='panel-title'>
                                <h3>账户登录</h3>
                            </div>
                        </div>
                        <div class='panel-body'>
                            <div class='container'>
                                <form role='form' class='form-inline'  action='login.php' method='post' onsubmit="return checkForm()">
                                 
                                    <lable><div class='glyphicon glyphicon-user tbUser'></div></lable>
                                    <input id='user' type='text' class='form-control input-lg inpUser' value='' name='username' placeholder='手机号/会员名/邮箱' autofocus><br><br>
                                    <lable><div class='glyphicon glyphicon-lock tbUser'></div></lable>
                                    <input id='pass' value='' type='password' class='form-control input-lg inpUser' name='password'><br><br>

                                    <input  class='btn btn-primary btnSub' type='submit' name='dosubmit' value='登录' />
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