<?php 
session_start();


  /*try{

  	$db = new PDO("mysql:dbname=lunch;host=localhost;charset=utf8","root","root");
  	$db->beginTransaction();

  	$sql = "UPDATE luch SET pass = :pass "


  }*/


  try{
  	$db = new PDO("mysql:dbname=lunch;host=localhost;charset=utf8","root","root");

  	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  	

  	$email = $_SESSION["email"];
  	$pass = $_SESSION["pass"];

  	$sql = 'UPDATE user SET pass = :pass WHERE email = :email';
  	$stmt = $db->prepare($sql);

  	$params = array(":email" => $email, ":pass" => password_hash($pass, PASSWORD_DEFAULT));

  	$stmt->bindValue(":email", $email);
  	$stmt->execute($params);
  }catch (PDOException $e){

  	echo "接続エラー", $e->getMessage();

  }


?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>パスワード変更完了画面</title>
        <link rel="stylesheet" href="css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
<body>


	<header></header>
	<div class="backmain">
	<div class="group">
		<p style="text-align: center;margin-top: 50px">変更が完了しました</p>
	<div class="logingroup">
	</div>
	<div class="button">
	  <a href="login.php">ログイン画面へ戻る</a>
    </div> 
    </div>
    </div>
    <footer></footer>
	
</body>
</html>