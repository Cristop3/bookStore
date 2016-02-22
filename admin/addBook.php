<?php
    /**
     *  addBook.php需要优化的地方：
     *      1.回车键的默认事件没有取消
     *
     *
     * 
     */
    include "../config.inc.php";
    include "../db.inc.php";
    include "../classes/fileupload.class.php";
    include "../classes/image.class.php";
    //echo "这是添加图书";
    
    

    if(isset($_POST['dosubmit'])){

        $up = new FileUpload();
        if($up->upload("bookPic")){
            $bookPic = $up->getFileName();

            $img = new Image("./uploads/");

            $img->thumb($bookPic,240,220,"index_");//修改后用来作主页展示240*220
            $img->thumb($bookPic,100,100,"admin_");//修改后用来在后台图书封面使用
        }else{
            echo "封面上传出错".$up->getErrorMsg();
            exit;
        }


        $bookISBN = $_POST['bookISBN'];
        $bookName = $_POST['bookName'];
        $bookAuthor = $_POST['bookAuthor'];
        $bookPrice = $_POST['bookPrice'];
        $bookPublish = $_POST['bookPublish'];
        $bookAbstract = $_POST['bookAbstract'];
        //将图片的名字存入数据库中
        $bookPic = $bookPic;

        try{

            $sql = "insert into mybook(bookISBN,bookName,bookAuthor,bookPrice,bookPublish,bookPic,bookAbstract) values(?,?,?,?,?,?,?)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute(array("{$bookISBN}","{$bookName}","{$bookAuthor}","{$bookPrice}","{$bookPublish}","{$bookPic}","{$bookAbstract}"));

            if($stmt->rowCount()>0){

                //echo $pdo->lastInsertId();
                
                //若成功添加图书成功,将最后插入的ID放到session中
                $_SESSION["isChangeID"] = $pdo->lastInsertId();
                $_SESSION['changeNow'] = true;                

                /*echo "<script>
                    window.location = 'admin_index.php';
                </script>";*/
            }else{
                echo "添加图书失败";
                echo $bookISBN;
                echo  $bookName;
                echo $bookPrice;
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
        <title>添加图书</title>
        <link rel='styleSheet' href='../style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='../style/config.inc.css' />
        <link rel='styleSheet' href='../style/layout_register.css' />
        <script type='text/javascript' src='../script/jquery-1.11.3.min.js'></script>
        <script type='text/javascript' src='../script/checkAddBook.js'></script>
        <style>
            .bgBox{background-image:url('../images/addBook_bg.png')}
        </style>
    </head>

    <body> 

            <form action='addBook.php' method='post' enctype='multipart/form-data'>
            <div class='bgBox'>
                <div class='reg_form'>
                    <h3>图书添加</h3>
                    <table class='form-table'>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookISBN</td>
                            <td class='td2'><input type='text' name='bookISBN' autofocus ></td>
                            <td><span class='showMes' value='bookISBN'>
                                        <img src='' class='showImg' value='bookISBN' />  
                                    </span></td>
                            <td class='divMes'><div id='bookISBN' value='bookISBN'></div></td>
                        </tr>
                         <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookName</td>
                            <td class='td2'><input type='text' name='bookName'></td>
                            <td><span class='showMes'>
                                    <img src='' class='showImg' value='bookName' />   
                            </span></td>
                            <td class='divMes'><div  value='bookName'></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookAuthor</td>
                            <td class='td2'><input type='text' name='bookAuthor'></td>
                            <td><span class='showMes'>
                                <img src='' class='showImg' value='bookAuthor' />
                            </span></td>
                            <td class='divMes'><div  value='bookAuthor'></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookPrice</td>
                            <td class='td2'><input type='text' name='bookPrice'></td>
                            <td><span class='showMes'>
                                <img src='' class='showImg' value='bookPrice' />
                            </span></td>
                            <td class='divMes'><div  value='bookPrice'></div></td>
                        </tr>
                       <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookPublish</td>
                            <td class='td2'><input type='text' name='bookPublish'></td>
                            <td><span class='showMes'>
                                <img src='' class='showImg' value='bookPublish' />
                            </span></td>
                            <td class='divMes'><div  value='bookPublish'></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookPic</td>
                            <td>
                                <div class='uploadBtn btn btn-primary'>
                                    <span>图书封面</span>
                                    <input type='hidden' name='MAX_FILE_SIZE' value='100000'>
                                    <input type='file' name='bookPic'>
                                </div>
                            </td>
                            <td><span class='showMes'>
                                <img src='' class='showImg' value='bookPic' />
                            </span></td>
                            <td class='divMes'><div value='bookPic'></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td style='font-size:18px;font-weight:bold;'>bookAbstract</td>
                            <td>
                               <textarea cols='26' rows='7' name='bookAbstract'></textarea> 
                            </td>
                            <td><span class='showMes'>
                                <img src='' class='showImg' value='bookAbstract' />
                            </span>
                            </td>
                            <td class='divMes'><div value='bookAbstract'></div></td>
                        </tr>
                    </table>
                    <input type='submit' name='dosubmit' value='添加' class='btn btn-success btn-lg'>
                    <a class='btn btn-info btn-lg' href='admin_index.php'>返回</a>
                </div>
                </div>
            </form>
    </body>
   
</html>




