<?php
    include "../config.inc.php";
    include "../db.inc.php";
    include "../classes/fileupload.class.php";
    include "../classes/image.class.php";

    //修改操作
    if(isset($_GET['action']) && $_GET['action']=='mod'){

        try{
            //获取要修改的那一条数据
            $sql = "select bookID,bookISBN,bookName,bookAuthor,bookPrice,bookPublish,bookPic,bookAbstract from mybook where bookID={$_GET['bookID']}";
            
            $results = $pdo->query($sql);

            if($results){
                list($bookID,$bookISBN,$bookName,$bookAuthor,$bookPrice,$bookPublish,$bookPic,$bookAbstract) = $results->fetch(PDO::FETCH_NUM);
                
                //$bookPic = "./uploads/admin_".$bookPic;
            echo $_FILES['bookPic'];

            }else{
                echo "没有对应的数据哦";
                exit;
            }

        }catch(PDOException $e){
            echo "ERROR:".$e->getMessage();
        }

    }

    //修改数据库中的数据

        if(isset($_POST['dosubmit'])){
            try{

                //如果用户有上传图片的动作
                if($_FILES['bookPic']['error']==0){
                    ///$bookPic = upload('bookPic');
                    
                    $up = new FileUpload();
                    if($up->upload("bookPic")){
                        $bookPic = $up->getFileName();
                        $img = new Image("./uploads/");
                        $img->thumb($bookPic,240,200,"index_");//前台使用
                        $img->thumb($bookPic,100,100,"admin_");//後台圖書列表使用

                    }else{
                        echo "修改图片未成功";
                        exit;
                    }

                    //删除原来的图片
                    @unlink("./uploads/{$_POST['oldImg']}");
                    @unlink("./uploads/index_{$_POST['oldImg']}");
                    @unlink("./uploads/admin_{$_POST['oldImg']}");

                    //修改全部mybook表的信息
                    $sql = "update mybook set bookISBN='{$_POST['bookISBN']}',bookName='{$_POST['bookName']}',bookAuthor='{$_POST['bookAuthor']}',bookPrice='{$_POST['bookPrice']}',bookPublish='{$_POST['bookPublish']}',bookPic='$bookPic',bookAbstract='{$_POST['bookAbstract']}' where bookID='{$_POST['bookID']}'";   

                }else{
                   
                    //修改除图片以外的信息
                    $sql = "update mybook set bookISBN='{$_POST['bookISBN']}',bookName='{$_POST['bookName']}',bookAuthor='{$_POST['bookAuthor']}',bookPrice='{$_POST['bookPrice']}',bookPublish='{$_POST['bookPublish']}',bookAbstract='{$_POST['bookAbstract']}' where bookID='{$_POST['bookID']}'";  
                }

                $results = $pdo->query($sql);

                if($results){
                    //echo "修改成功";
                    echo "<script>
                        window.location = 'listBook.php';
                    </script>";
                }else{
                    echo "修改失败";
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
        <title>修改图书信息</title>
        <link rel='styleSheet' href='../style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='../style/config.inc.css' />
        <link rel='styleSheet' href='../style/layout_register.css' />
        <script type='text/javascript' src='../script/jquery-1.11.3.min.js'></script>
        <script type='text/javascript' src='../script/checkAddBook.js'></script>
        <style>
            .bgBox{background-image:url('../images/modBook_bg.png')}
            .show{display:block;}
        </style>
    </head>

    <body> 

            <form action="modBook.php?action=mod&bookID=<?php echo $_GET['bookID']?>" method='post' enctype='multipart/form-data'>
            <div class='bgBox'>
                <div class='reg_form'>
                    <h3>修改图书</h3>
                    <table class='form-table'>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookISBN</td>
                            <td class='td2'><input type='text' name='bookISBN' value="<?php echo $bookISBN; ?>" ></td>
                            <td><span class='showMes' value='bookISBN'>
                                        <img src='' class='showImg' value='bookISBN' />  
                                    </span></td>
                            <td class='divMes'><div id='bookISBN' value='bookISBN'></div></td>
                        </tr>
                         <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookName</td>
                            <td class='td2'><input type='text' name='bookName' value="<?php echo $bookName; ?>"></td>
                            <td><span class='showMes'>
                                    <img src='' class='showImg' value='bookName' />   
                            </span></td>
                            <td class='divMes'><div  value='bookName'></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookAuthor</td>
                            <td class='td2'><input type='text' name='bookAuthor' value="<?php echo $bookAuthor; ?>"></td>
                            <td><span class='showMes'>
                                <img src='' class='showImg' value='bookAuthor' />
                            </span></td>
                            <td class='divMes'><div  value='bookAuthor'></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookPrice</td>
                            <td class='td2'><input type='text' name='bookPrice' value="<?php echo $bookPrice; ?>"></td>
                            <td><span class='showMes'>
                                <img src='' class='showImg' value='bookPrice' />
                            </span></td>
                            <td class='divMes'><div  value='bookPrice'></div></td>
                        </tr>
                       <tr>
                            <td><span class='span1'>*</span></td>
                            <td class='td1'>bookPublish</td>
                            <td class='td2'><input type='text' name='bookPublish' value="<?php echo $bookPublish; ?>"></td>
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
                            <td class='divMes'><div value='bookPic' class='show'><input type='hidden' name='oldImg' value='<?php echo $bookPic; ?>'><img src="<?php echo "./uploads/admin_".$bookPic; ?>" /></div></td>
                        </tr>
                        <tr>
                            <td><span class='span1'>*</span></td>
                            <td style='font-size:18px;font-weight:bold;'>bookAbstract</td>
                            <td>
                               <textarea cols='26' rows='7' name='bookAbstract'><?php echo $bookAbstract; ?></textarea> 
                            </td>
                            <td><span class='showMes'>
                                <img src='' class='showImg' value='bookAbstract' />
                            </span>
                            </td>
                            <td class='divMes'><div value='bookAbstract'><input type='hidden' name='bookID' value='<?php echo $bookID; ?>' /></div></td>
                        </tr>
                    </table>
                    <input type='submit' name='dosubmit' value='修改' class='btn btn-success btn-lg'>
                    <a class='btn btn-info btn-lg' href='listBook.php'>返回</a>
                </div>
                </div>
            </form>
    </body>
   
</html>