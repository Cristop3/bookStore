<?php
    /**
     *  此处需要优化的地方：
     *   1.这里删除只能把数据库里的信息删除了 但实际存在服务器端的图片还没删除
     *       至于怎么处理？
     *           针对单条数据-根据bookID再查询数据库把bookPic获取再删除
     *           针对多条数据-感觉就没有那么好办了。。。
     *
     *
     * 
     */
    include "../config.inc.php";
    include "../db.inc.php";
    include "../classes/page.class.php";

    //判断用户是否有删除操作
    if(isset($_GET['action']) && $_GET['action']=='del'){
       
            
       try{
            //删除多个记录
         if(!empty($_POST['bookID'])){
                
                //删除多条记录 通过in来判断他们的bookID
                $sql = "delete from mybook where bookID in(".implode(',', $_POST['bookID']).")";
                $pdo->exec($sql);

                //把删除的图书的三种类型的图片也要删除
            }else{
                //删除单个图书记录
                $sql = "delete from mybook where bookID=?";
                $stmt = $pdo->prepare($sql);
                
                $stmt->execute(array("{$_GET['bookID']}"));

                if($stmt->rowCount()>0){
                    //echo "删除成功";
                }else{
                    echo "删除失败";
                    exit;
                }
            } 
               
        }catch(PDOException $e){
            echo "ERROR:".$e->getMessage();
        }

    }
?>
<html>
    <head>
        <meta charset='utf-8'>
        <title>增加/删除图书页面</title>
        <link rel='styleSheet' href='../style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='../style/config.inc.css'/>
        <link rel='styleSheet' href='../style/admin_modadd.css' />
    </head>

    <body>
        <div class='head'>
            <span>增加/删除图书页面</span>
        </div>
        <div class='box'>
            <div class='container'>
                <div class='row'>
                    <div class='col-md-12 '>
                        <?php

                            try{
                                //执行分页操作
                                $sql1 = "select count(*) as total from mybook";
                                $result = $pdo->query($sql1);
                                $data = $result->fetchColumn();
                                //echo $data;
                                $page = new Page($data,10);//创建分页对象


                                //执行查询数据操作
                        $sql2 = "select bookID,bookPic,bookISBN,bookName,bookAuthor,bookPrice,bookPublish from mybook order by bookID {$page->limit}";

                                /*修改
                                $stmt = $pdo->prepare($sql2);
                                $stmt->execute();
                                */
                               $results = $pdo->query($sql2);

                               
                               // if(!empty($stmt->fetch(PDO::FETCH_NUM))){
                               if($results){
                                    echo '<form action="listBook.php?action=del&page='.$page->page.'" method="post" onsubmit="return confirm(\'你确定要删除这些图书吗?\')" >';
                                    echo "<table class='table table-bordered table-striped'>";
                                    echo "<thead>";
                                        echo "<tr>";
                                        echo "<th>批量操作</th>";
                                        echo "<th>图书封面</th>";
                                        echo "<th>图书ISBN</th>";
                                        echo "<th>图书名称</th>";
                                        echo "<th>图书作者</th>";
                                        echo "<th>图书价格</th>";
                                        echo "<th>出版社</th>";
                                        echo "<th>操作</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                        /*while(list($bookID,$bookPic,$bookISBN,$bookName,$bookAuthor,$bookPrice,$bookPublish) = $stmt->fetch(PDO::FETCH_NUM)){
                                            $bookPic = "./uploads/admin_".$bookPic;

                                            echo "<tr>";
                                            echo '<td><input type="checkbox" name="bookID[]" class="checkbox" value='.$bookID.'/></td>';
                                            echo "<td><img class='img img-rounded' src='".$bookPic."' /></td>";
                                            echo "<td><span>{$bookISBN}</span></td>";
                                            echo "<td><span>《{$bookName}》</span></td>";
                                            echo "<td><span><b>{$bookAuthor}</b></span></td>";
                                            echo '<td><span>￥'.number_format($bookPrice,2,'.','').'</span></td>';
                                            echo "<td><span><i>{$bookPublish}</i></span></td>";
                                            echo "<td><span><a href='modBook.php?action=mod&bookID={$bookID}'>修改</a>/<a href='modBook.php?action=del&bookID='>删除</a></span></td>";
                                            echo "</tr>";*/
                                        $arr = $results->fetchAll(PDO::FETCH_NUM);
                                        foreach($arr as $row){
                                            list($bookID,$bookPic,$bookISBN,$bookName,$bookAuthor,$bookPrice,$bookPublish) = $row;
                                            $bookPic = "./uploads/admin_".$bookPic;

                                            echo "<tr>";
                                            echo '<td><input type="checkbox" name="bookID[]" class="checkbox" value='.$bookID.'></td>';
                                            echo "<td><img class='img img-rounded' src='".$bookPic."' /></td>";
                                            echo "<td><span>{$bookISBN}</span></td>";
                                            echo "<td><span>《{$bookName}》</span></td>";
                                            echo "<td><span><b>{$bookAuthor}</b></span></td>";
                                            echo '<td><span>￥'.number_format($bookPrice,2,'.','').'</span></td>';
                                            echo "<td><span><i>{$bookPublish}</i></span></td>";
                                            echo '<td><span><a href="modBook.php?action=mod&bookID='.$bookID.'">修改</a>/<a href="listBook.php?action=del&bookID='.$bookID.'" onclick="return confirm(\'你确定要删除《'.$bookName.'》这个图书吗？\')">删除</a></span></td>';
                                            echo "</tr>";

                                        }

                                        
                                        echo "<tr><td><button type='submit' name='dosubmit' class='btn btn-danger btn-sm'>批量删除</button></td><td colspan='7'>".$page->fpage()."</td></tr>";
                                    echo "</tbody>";

                                    echo "</table>";
                                    echo "</form>";
                                }else{
                                    echo "未找到数据....";
                                    exit;
                                }


                
                            }catch(PDOException $e){
                                echo "ERROR:".$e->getMessage();
                            }

                        ?>

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>