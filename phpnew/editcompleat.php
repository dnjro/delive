<?php session_start(); 
$user = 'root';
$password = 'root';
$dbname = 'lunch';
$host = 'localhost:3306';


$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";



 if($_SESSION["validation"] !=2){
    $_SESSION["validation"] = 0;
    header("Location: login.php");
  }else{
    $_SESSION["validation"]=0;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>cafe</title>
  
  
  <link rel="stylesheet" type="text/css" href="css/editcompleat.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
  	$(function(){
  		

      $(".soushinn").mouseover(function(){
        $(this).css("cursor","pointer")
      });

      $(".modoru").mouseover(function(){
        $(this).css("cursor","pointer")
      });
    });

  </script>
</head>

<body>

  <?php

  

  try{
    
    $db= new PDO("mysql:dbname=lunch;host=localhost;charset=utf8","root","root");
    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // データを取得
    $name = $_SESSION["name1"];
    $email = $_SESSION["email"];
    $pass = $_SESSION["pass"];
    $id = $_SESSION['id'];
    $address = $_SESSION['address'];

    
    $sql = 'UPDATE user SET name = :name, email = :email, pass = :pass, address = :address WHERE id = :id';
    $stmt = $db->prepare($sql);
    
    $params = array(":name" => $name, ":email" => $email, ":id" => $id, ":pass" => password_hash($pass, PASSWORD_DEFAULT), ":address" => $address);
    
    $stmt->bindValue(':id', $id);
    $stmt->execute($params);
  }catch (PDOException $e) {
    echo "接続エラー",$e->getMessage();
  }

  


  ?>


  <header></header>

  

  <div class="compleat">

    <div class="compgroup">
      <p class="compp">変更完了</p>
    </div>
    
      <div class="index"> 
         <a href="index.php" class="compindex">topへ戻る</a>
      </div>
  </div>

  <footer></footer>
</body>
</html>