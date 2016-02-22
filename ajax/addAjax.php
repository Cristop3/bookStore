<?php
    include "config.inc.php";
    include "db.inc.php";
    header('Content-type:text/json');

    //echo $_SESSION['isChangeID'];
    if($_SESSION['changeNow'] == true){

        try{

            $sql = "select bookID,bookPic,bookName,bookPrice from mybook where bookID={$_SESSION['isChangeID']}";

            $stmt = $pdo->prepare($sql);

            $stmt->execute();
            // echo "1111";

           if($stmt->rowCount()>0){
                //print_r($stmt->fetch(PDO::FETCH_NUM))."<br>";
                //$result = $stmt->fetch(PDO::FETCH_NUM);
                //print_r($result)."123";
                //list($bookPic,$bookName,$bookPrice) = $stmt->fetch(PDO::FETCH_NUM);
                //$bookPic = "./admin/uploads/".$bookPic;
                //echo $bookPic.$bookName.$bookPrice;

                //向前台返回json格式数据
                $result = json_encode($stmt->fetch(PDO::FETCH_ASSOC));
                //print_r($result);
                echo $result;
                $_SESSION['changeNow'] = false;

            }

        }catch(PDOException $e){
            echo "ERROR:".$e->getMessage();
        }
    }
?>