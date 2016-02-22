<?php
    include "config.inc.php";
    include "db.inc.php";
    include "header.php";
?>
<html>
    <head>
        <meta charset='utf-8'>
        <title>商品详情</title>
        <link rel='styelSheet' href='./style/bootstrap-3.3.5-dist/css/bootstrap.min.css' />
        <link rel='styleSheet' href='./style/config.inc.css' />
        <link rel='styleSheet' href='./style/details.css' />
        <script type='text/javascript' src='./script/jquery-1.11.3.min.js'></script>
        <script type='text/javascript' src='./script/jquery.jqzoom.js'></script>
        <script type='text/javascript' src='./script/jquery.livequery.js'></script>
        <script type='text/javascript' src='./script/jquery.fly.min.js'></script>
        <script type='text/javascript' src='./script/startMove.js'></script>
        <script>
            window.onload = function(){
                /*var oUl = document.getElementById('scrollUl');
                var aLi = oUl.getElementsByTagName('li');
                var timer = null;
                var speed = -10;
                oUl.innerHTML += oUl.innerHTML;
                oUl.style.height = aLi.length * aLi[0].offsetHeight + 'px';
                //无缝滚动功能
                
                timer = setInterval(function(){
                    if(oUl.offsetTop < -oUl.offsetHeight/2){
                        oUl.style.top = 0 + 'px';
                    }
                    oUl.style.top = oUl.offsetTop + speed + 'px';
                
                },50)*/
                var onoff = true;
                var oCar = document.getElementById('end');
                var oShowCar = document.getElementById('moveCar');
                oCar.onclick = function(){
                    if(onoff){
                        startMove(oShowCar,{right:0});
                        onoff = false;
                    }else{
                        startMove(oShowCar,{right:-200});
                        onoff = true;
                    }
                    
                }

            };
        </script>
    </head>
    <body> 
        <div class='box'>
            <div class='details'>
                <div class='details_left'>
                    <div class='left_bigImg'>
                        <div class='jqzoom'>
                            <img src='images/details/sml2_center.png' class='fs' alt='' jqimg='images/details/center2_big.png' id='bigImg' />
                        </div>
                    </div>
                    <div class='left_smlImg'>
                        <ul>
                            <li><img src='./images/details/sml2.png' height="80" width="80"/></li>
                            <li><img src='./images/details/sml3.png' height="80" width="80"/></li>
                            <li><img src='./images/details/sml4.png' height="80" width="80"/></li>
                            <li><img src='./images/details/sml.png' height="80" width="80"/></li>  
                        </ul>
                    </div>
                </div>
                <div class='details_right'>
                   <div class='right_inner'>
                        <p class='bookName'>书名：<span>javascript权威指南</span></p>
                        <dl class='bookAbstract'>简介:<p>这是javascript中的圣经</p></dl>
                        <div class='detls'>
                            <p>价格：<span>69.00</span></p>
                            <p>ISBN：<span>5648792130</span></p>
                            <p>出版社：<span>CUIT</span></p>
                            <p>数量：
                                <select id='num_sort' style='width:40px;'>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </p>
                        </div>
                        <div class='cart'>
                            <button class='btn btn-info btn-lg'>立即购买</button>
                            <button class='btn btn-info btn-lg addcar'>加入购物车</button>
                        </div>
                        <div>
                            <img src='./images/copy.png' height="70" width="510" />
                        </div>
                   </div>
                </div>

            </div>
            <div class='scrollImg'>
                <ul id='scrollUl'>
                    <li><img src='./images/11.jpg'  /></li>
                    <li><img src='./images/13.jpg'  /></li>
                    <li><img src='./images/15.jpg'  /></li>
                    <li><img src='./images/5.jpg'  /></li>
                    <li><img src='./images/9.jpg'  /></li>
                </ul>
            </div>
        </div>
        <div class='outCar' id='moveCar'>
            <div class='cartBar' >
                <div class='cartOne'>
                    <dl id='end'></dl>
                    <a href='cart.php'><span class='carNum'>购物车</span></a>
                </div>
            </div>
            <div class='detailCar'>
                <p class='pHead'>我的购物车</p>
                <hr></hr><!--
                <div class='smlCar'>
                    <div class='carImg'><img src='images/details/sml2.png' height="80" width="80" /></div>
                    <div class='right_car'>
                        <p>javascript权威指南</p>
                        <p>价格:69.00</p>
                    </div>
                </div>-->
                <button class='btn btn-danger goCar'>去购物车结算</button>
            </div>
        </div>
        <div id="msg">已成功加入购物车！</div> 
        <script>
            $(function(){
                //放大镜
                $('.jqzoom').jqueryzoom({
                    "xzoom":200,
                    "yzoom":200,
                    "offset":10,
                    "position":'right',
                    "preload":1
                });

                /*点击小图切换大图---并动态绑定事件*/
                $('.left_smlImg ul li img').livequery('click',function(){
                   var imgSrc = $(this).attr('src');// ./images/details/sml4.png
                   //alert(imgSrc);
                   var i = imgSrc.lastIndexOf('.');
                   //alert(i);
                   var unit = imgSrc.substring(i); // .png
                   //alert(unit);
                   imgSrc = imgSrc.substring(0,i);
                   var imgSrc_new = imgSrc + '_center' + unit;
                   $('#bigImg').attr({
                        "src":imgSrc_new,
                        "jqimg":imgSrc_new
                   });
                   $(this).parent().addClass('active').siblings().removeClass('active'); 
                });

                /*加入购物车*/
                var num = 0;
                $('.addcar').click(function(event){
                    num++;
                    var offset = $("#end").offset();//获取结束位置
                    var addcar = $(this);
                    var flyer = $('<img class="u-flyer" src="./images/carImg.png" />');

                    flyer.fly({
                        //抛物线起始位置
                        start:{
                            left:event.pageX,
                            top:event.pageY
                        },
                        //抛物线结束位置
                        end:{
                            left:offset.left + 10,
                            top:offset.top + 10,
                            width:0,
                            height:0
                        },
                        onEnd:function(){
                            $('.carNum').html("购物车"+"("+num+")");
                            $("#msg").show().animate({width:'250px'},200).fadeOut(1000),
                            this.destory()
                        }
                    });

                    /*点击加入购物车显示商品小详情*/
                    $('<div class="smlCar"><div class="carImg"><img src="images/details/sml2.png" height="80" width="80" /></div><div class="right_car"><p>javascript权威指南</p><p>价格:69.00</p></div></div>').appendTo($(".detailCar"));

                });

                /*查看购物车
                $("#end").click(function(){
                    startMove($(".cartBar"),'right',100,function(){alert(1)})
                });*/
            });
        </script>
    </body>
   
