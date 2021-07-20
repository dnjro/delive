<?php session_start(); 
$user = 'root';
$password = 'root';
$dbname = 'lunch';
$host = 'localhost:3306';


$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";




 if($_SESSION["validation"] != 2){
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
  <!-- ?v=2 -> スタイルシートの都度更新 -->
  <link rel="stylesheet" type="text/css" href="base.css?v=2">
  <link rel="stylesheet" type="text/css" href="css/compleat.css">
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
    // PDOインスタンス生成
    $db= new PDO("mysql:dbname=lunch;host=localhost;charset=utf8","root","root");
    // エラーレポート表示
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // データを取得
    $name = $_SESSION["name1"];
    $email = $_SESSION["mail"];
    $pass = $_SESSION["pass"];
    $address = $_SESSION["address"];

    // databaseにinsertする土台を生成データは空
    $sql = 'INSERT INTO user (name, email, address, pass, role ) VALUES (:name, :email, :address, :pass, :role)';
    $stmt = $db->prepare($sql);
    // データの値を変数に格納
    $params = array(":name" => $name, ":email" => $email, ":address" => $address, ":pass" => password_hash($pass, PASSWORD_DEFAULT), ':role' => 100);
    // insertの土台に値を入れクエリを実行する
    $stmt->execute($params);
  }catch (PDOException $e) {
    echo "接続エラー",$e->getMessage();
  }

  


  ?>

  <header></header>

  

  <div class="compleat">

    <div class="compgroup">
      <p class="compp">登録完了</p>
    </div>
    
      <div class="index"> 
         <a href="login.php" class="compindex">ログイン画面へ進む</a>
      </div>
    
    
  </div>


  <footer></footer>

  





</body>
</html>