<?php
    /**
     *  修改页面需要优化的地方：
     *      1.我是完全将注册页面扔过来，应该有简易的方法
     *
     * 
     */
    include "config.inc.php";
    include "db.inc.php";
    include "classes/fileupload.class.php";
    include "classes/image.class.php";
    include "header.php";

    //echo "这里是修改页面";
    /*
    $userID = $_SESSION['userID'];//通过userID来确定用户

    //获取当前用户的数据信息
    try{

        $sql = "select username,password,email,phone,pic,address from user where userID=?";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(array("{$userID}"));

        if($stmt->rowCount()>0){
            list($username,$password,$email,$phone,$pic,$address) = $stmt->fetch(PDO::FETCH_NUM);
            $pic = "th_".$pic;
        }else{
            echo "( ⊙ o ⊙ )啊哦 服务器开小差了";
        }

    }catch(PDOException $e){
        echo "ERROR:".$e->getMessage();
    }*/
       // print_r($_SESSION);

    //当提交修改后的信息
    if(isset($_POST['dosubmit'])){

        //提交处理修改后的头像
        $up = new FileUpload();
        if($up->upload("pic")){
            $pic = $up->getFileName();
            $img = new Image("./uploads/");

            //处理头像
            $img->thumb($pic,50,50,"th_");
        }else{
            echo "头像上传失败".$up->getErrorMsg();
            exit;
        }

        //获取表单信息
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pic = $pic;
        $address = $_POST['address'];
        

        $sql = "update user set username=?,password=?,email=?,phone=?,pic=?,address=? where userID=?";

        $stmt = $pdo->prepare($sql);
        $userID = $_SESSION['userID'];
        $stmt->execute(array("{$username}","{$password}","{$email}","{$phone}","{$pic}","{$address}","{$userID}"));

        if($stmt->rowCount()>0){
            $oldPic = $_SESSION['pic'];//原session中存的pic
            $oldPic_head = "th_".$oldPic; 
            //删除原来的头像资源
            unlink("./uploads/{$oldPic}");
            unlink("./uploads/{$oldPic_head}");

            //把session内容更新
            //$_SESSION = $stmt->fetch(PDO::FETCH_NUM);
            $_SESSION['username'] = $username;//将用户名存入session中
            $_SESSION['pic'] = $pic;//将头像文件名存入session中
            $_SESSION['password'] = $password;
            $_SESSION['email'] = $email;
            $_SESSION['address'] = $address;
            $_SESSION['phone'] = $phone;
            //print_r($_SESSION);
            //修改成功后调至主页
            echo "<script>
                setTimeout(function(){
                    window.location = 'index.php';
                },1000);
            </script>";
    
        }
    }   
?>

<html>
    <head>
        <meta charset=utf-8 />
        <title>修改页面</title>
        <link rel='styleSheet' href='style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='style/config.inc.css' />
        <link rel='styleSheet' href='style/layout_register.css' />
        <script type='text/javascript' src='script/jquery-1.11.3.min.js'></script>
        <script type='text/javascript' src='script/checkUser.js'></script>
    </head>
    <body>
        <div class='box'>
        <form action='modify.php' method='post' enctype='multipart/form-data'>
            <div class='bgBox'>
                <div class='reg_form'>
                    <h3>修改资料</h3>
                    <table class='form-table'>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>用户名</td>
                            <td class='td2'><input type='text' name='username' autofocus  value="<?php echo $_SESSION['username']; ?>" ></td>
                            <td><span class='showMes' value='username'>
                                        <img src='images/right.png' class='showImg' value='username' />  
                                    </span></td>
                            <td class='divMes'><div id='username' value='username'></div></td>
                        </tr>
                         <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>密码</td>
                            <td class='td2'><input type='password' name='password' value="<?php echo $_SESSION['password']; ?>"></td>
                            <td><span class='showMes'>
                                    <img src='images/right.png' class='showImg' value='password' />   
                            </span></td>
                            <td class='divMes'><div  value='password'>密码个数6-10</div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>电话</td>
                            <td class='td2'><input type='text' name='phone' value="<?php echo $_SESSION['phone']; ?>"></td>
                            <td><span class='showMes'>
                                <img src='images/right.png' class='showImg' value='phone' />
                            </span></td>
                            <td class='divMes'><div  value='phone'>格式不对</div></td>
                        </tr>
                       <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>邮箱</td>
                            <td class='td2'><input type='text' name='email' value="<?php echo $_SESSION['email']; ?>"></td>
                            <td><span class='showMes'>
                                <img src='images/right.png' class='showImg' value='email' />
                            </span></td>
                            <td class='divMes'><div  value='email'>邮箱格式不对</div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>头像</td>
                            <td>
                                <div class='uploadBtn btn btn-primary'>
                                    <span>修改头像</span>
                                    <input type='hidden' name='MAX_FILE_SIZE' value='100000'>
                                    <input type='file' name='pic'>
                                </div>
                            </td>
                            <td><span class='showMes'>
                                <img src='images/right.png' class='showImg' value='pic' />
                            </span></td>
                            <td class='divMes'><div class='showTX' value='pic'></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td style='font-size:18px;font-weight:bold;'>地址</td>
                            <td>
                               <textarea cols='24' rows='5' ><?php echo $_SESSION['address'];?></textarea> 
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    <input type='submit' name='dosubmit' value='确认修改' class='btn btn-success btn-lg'>
                    <button class='btn btn-info btn-lg'>取消</button>
                </div>
                </div>
            </form>

        </div>
    </body>
</html>