<?php
    /**
     *  2016.1.14
     *  注册页面还需要优化的地方：
     *      1.判断是否全部信息填写完成！
     *      2.关于表单的取消按钮代码控制！
     *      3.在填写用户名的时候，解决为keyup完ajax判断，blur判断是否合法！
     *
     * 
     */
    include "config.inc.php";
    include "db.inc.php";
    include "classes/fileupload.class.php";
    include "classes/image.class.php";


    //注册提交处理
    if(isset($_POST['dosubmit'])){

        //创建文件类的对象
        $up = new FileUpload();
        if($up->upload("pic")){
            $pic = $up->getFileName();//获取文件名字

            //创建图片类对象
            $img = new Image("./uploads/");
            $img->thumb($pic,50,50,"th_");//缩减成50*50的来做用户头像图片文件
        }else{
            echo "头像未上传成功，请重新试试!".$pic->getErrorMsg();
            exit;  
        }

        //获取表单内容
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $pic = $pic; //将文件名存入数据库

        try{
            $sql = "insert into user(username,password,email,phone,pic,address) value(?,?,?,?,?,?)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute(array("{$username}","{$password}","{$email}","{$phone}","{$pic}","{$address}"));

            //若注册成功
            if($stmt->rowCount()>0){

                $_SESSION['username'] = $username;//将用户名存入session中
                $_SESSION['pic'] = $pic;//将头像文件名存入session中
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $email;
                $_SESSION['address'] = $address;
                $_SESSION['phone'] = $phone;

                //注册成功后 跳转到主页 用js?还是用head?
                echo "<script>setTimeout(function(){
                    window.location = 'index.php';
                },1000)</script>";
            }
        }catch(PDOException $e){
            echo "ERROR:".$e->getMessage();
        }

    }

?>

<html>
    <head>
        <meta charset=utf-8 />
        <title>注册页面</title>
        <link rel='styleSheet' href='style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='style/config.inc.css' />
        <link rel='styleSheet' href='style/layout_register.css' />
        <script type='text/javascript' src='script/jquery-1.11.3.min.js'></script>
        <script type='text/javascript' src='script/checkUser.js'></script>
    </head>
    <body>
        <div class='box'>
        <form action='register.php' method='post' enctype='multipart/form-data'>
            <div class='bgBox'>
                <div class='reg_form'>
                    <h3>用户注册</h3>
                    <table class='form-table'>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>用户名</td>
                            <td class='td2'><input type='text' name='username' autofocus ></td>
                            <td><span class='showMes' value='username'>
                                        <img src='images/right.png' class='showImg' value='username' />  
                                    </span></td>
                            <td class='divMes'><div id='username' value='username'></div></td>
                        </tr>
                         <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>密码</td>
                            <td class='td2'><input type='password' name='password'></td>
                            <td><span class='showMes'>
                                    <img src='images/right.png' class='showImg' value='password' />   
                            </span></td>
                            <td class='divMes'><div  value='password'>密码个数6-10</div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>电话</td>
                            <td class='td2'><input type='text' name='phone'></td>
                            <td><span class='showMes'>
                                <img src='images/right.png' class='showImg' value='phone' />
                            </span></td>
                            <td class='divMes'><div  value='phone'>格式不对</div></td>
                        </tr>
                       <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>邮箱</td>
                            <td class='td2'><input type='text' name='email'></td>
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
                                    <span>上传头像</span>
                                    <input type='hidden' name='MAX_FILE_SIZE' value='100000'>
                                    <input type='file' name='pic'>
                                </div>
                            </td>
                            <td><span class='showMes'>
                                <img src='images/right.png' class='showImg' value='pic' />
                            </span></td>
                            <td class='divMes'><div value='pic'></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td style='font-size:18px;font-weight:bold;'>地址</td>
                            <td>
                               <textarea cols='24' rows='5' name='address'></textarea> 
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                    <input type='submit' name='dosubmit' value='注册' class='btn btn-success btn-lg'>
                    <button class='btn btn-info btn-lg'>取消</button>
                </div>
                </div>
            </form>

        </div>
    </body>
</html>