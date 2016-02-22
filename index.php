<?php
    include "config.inc.php";
    include "header.php";

?>
        <div class='clearFloat'></div>
        <div class='content'>
            <div class='search_top'>
                <form action='' method='' class='form-search'>
                    <input type='text' name='searchMall' class='search-query input-lg formInp' placeholder='轻轻的我来了....' />
                    <button type='submit' class='btn btn-primary'>"嗖"的一下下</button>
                </form>
              
                <ul class='search_nav'>
                    <li><a href='#'>盗墓笔记</a></li>
                    <li><a href='#'>鬼吹灯</a></li>
                    <li><a href='#'>诛仙</a></li>
                    <li><a href='#'>戮仙</a></li>
                    <li><a href='#'>斗破苍穹</a></li>
                    <li><a href='#'>三国演义</a></li>
                    <li><a href='#'>和空姐同居的日子</a></li>
                </ul>
            </div>
           
            <div class='showImg'>
                <ul class='showImg_ul' id='ul1'>
                    <li class='active'>1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                </ul>
                <img id='showImg' src='images/showImg1.png' height="400" width="1184" />              
            </div>
            
            <div class='showBook' id='autoBook'>
                <ul id='autoUL'>
                    <li>
                        <a href='#'><img src='images/book1.png' height="200" width="200"></a>
                        <span class='showBook_span1'><a href='#'>成语故事大搜集</a></span>
                        <span class='showBook_span2'>价格:￥23.00</span>
                    </li>
                    <li>
                        <a href='#'><img src='images/book2.png' height="200" width="200"></a>
                        <span class='showBook_span1'><a href='#'>青春故事-我们</a></span>
                        <span class='showBook_span2'>价格:￥18.00</span>
                    </li>
                    <li>
                        <a href='#'><img src='images/book3.png' height="200" width="200"></a>
                        <span class='showBook_span1'><a href='#'>小学生益智游戏故事</a></span>
                        <span class='showBook_span2'>价格:￥46.00</span>
                    </li>
                    <li>
                        <a href='#'><img src='images/book4.png' height="200" width="200"></a>
                        <span class='showBook_span1'><a href='#'>读书不是为了爸妈读</a></span>
                        <span class='showBook_span2'>价格:￥34.00</span>
                    </li>
                    <li>
                        <a href='#'><img src='images/book5.png' height="200" width="200"></a>
                        <span class='showBook_span1'><a href='#'>大圣归来之猴王的故事</a></span>
                        <span class='showBook_span2'>价格:￥57.00</span>
                    </li>
                    <?php
                        include "db.inc.php";
                        //前台页面查询mybook表取出数据展示
                        try{
                            //echo "111";
                            $sql = "select bookID,bookName,bookPic,bookPrice from mybook order by bookID";

                            //$stmt = $pdo->prepare($sql);
                            $result = $pdo->query($sql);

                            //$stmt->execute();

                            //获取数据库的内容
                            /*if(!empty($stmt->fetch(PDO::FETCH_NUM))){
                               //echo "120";
                               while(list($bookName,$bookPic,$bookPrice) = $stmt->fetch(PDO::FETCH_NUM)){
                                    echo $bookName.'+'.$bookPic.'+'.$bookPrice."<br>";
                               }*/
                            if($result){
                               $arr = $result->fetchAll(PDO::FETCH_NUM);
                                //print_r($row);
                                foreach($arr as $row){
                                   list($bookID,$bookName,$bookPic,$bookPrice) = $row;
                                   $bookPic = "admin/uploads/".$bookPic;
                                    //echo $bookName.'+'.$bookPic.'+'.$bookPrice."<br>";
                                   echo '<a href="details.php?action=show&bookID='.$bookID.'"><li><img src="'.$bookPic.'" height="200" width="200"/><a href="#"><span class="showBook_span1">'.$bookName.'</span></a><span class="showBook_span2">价格￥'.number_format($bookPrice,2,".","").'</span></li></a>';
                                }
                                
                            }else{
                                echo "数据为空";
                            }

                        }catch(PDOException $e){
                            echo "ERROR:".$e->getMessage();
                        }
                    ?>
                </ul>
            </div>
        <div class='foot'>
            <img src='images/foot.png' height="561" width="1194" />
        </div>
        </div><!--content结束-->

        <script>
            $(function(){

                //1.图片展示小图标处理
                var num=1;
                var timer = setInterval(function(){
                    num++;
                    if(num==5){
                        num=1;
                    }
                    $("#showImg").attr("src","images/showImg"+num+".png");
                    $("#ul1").find("li").eq(num-1).addClass("active").siblings().removeClass('active');
                },3000);

                //2.ajax定时10s轮询检查更新主页图书
                timer = setInterval(function(){
                    $.ajax({
                        type:"post",
                        url:"addAjax.php",
                        dataType:"json",
                        success:function(json){
                            var bookID;
                            var bookName;
                            var bookPic;
                            var bookPrice;
                            
                            //从json中取出数据 暂时只想的这种方式
                            $.each(json,function(attr,value){
                                if(attr=="bookName"){
                                    bookName = value;
                                }else if(attr=="bookPic"){
                                    bookPic = "./admin/uploads/"+value;
                                }else if(attr=="bookPrice"){
                                    bookPrice=value;
                                }else{
                                    bookID=value;
                                }
                            });
                            /*
                            $("#autoUL").append('<li><a href="#"><img src="'+bookPic+'" height="200" width="200"/></a><a href="#"><span class="showBook_span1">'+bookName+'</span></a><span class="showBook_span2">价格￥'+bookPrice+'.00</span></li>');
                            */
                            $('<li><a href="details.php?action=show&bookID='+bookID+'"><img src="'+bookPic+'" height="200" width="200"/></a><a href="#"><span class="showBook_span1">'+bookName+'</span></a><span class="showBook_span2">价格￥'+bookPrice+'.00</span></li>').appendTo($("#autoUL")).hover(function(){
                                $(this).addClass('active2');
                            },function(){
                                $(this).removeClass('active2');
                            });

                        }
                    });
                },10000);
                
                //3.默认图书的hover处理
                 $('#autoBook').find('li').hover(function(){
                    $(this).addClass('active2');
                },function(){
                    $(this).removeClass('active2');
                });
            });
        </script>
    </body>
</html>