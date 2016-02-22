<?php
        include "config.inc.php";
        include "db.inc.php";

        if(isset($_GET['username'])){
            $username = $_GET['username'];
            try{
           
                $sql = "select username from user where username=?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(["{$username}"]);

                if(is_array($stmt->fetch(PDO::FETCH_NUM))){
                    echo "1";
                }else{
                    echo "0";
                }

            }catch(PDOException $e){
                 echo "ERROR:".$e->getMessage();
            }
        }else{
            echo "有问题";
            exit;
        }

?>