<?php 
 session_start();


  $postdata = $_POST['email'];

  $db= new PDO("mysql:dbname=lunch;host=localhost;charset=utf8","root","root");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  if($db == null){
  	echo "接続に失敗しました";
  }else{
  	$sql = "SELECT * FROM user WHERE email = :email";

  	$params = array(":email" => $postdata);

  	$stmt = $db->prepare($sql);
  	$stmt->execute($params);
  	$data = $stmt->fetch(PDO::FETCH_ASSOC);
  	if(!empty($data)){


  	 //ランダムな番号の作成
  	 $passResetToken = md5(uniqid(rand(),true));


     //ランダムに生成したurl（送信用）
  	 $reseturlsend = 'http://localhost/phpnew/passresetform.php?passRset='.$passResetToken.'';


  	 $reset_time = date("Y-m-d H:i:s");

  	 $sql = 'INSERT INTO para (reset_url, reset_time)
  	         VALUES (:reset_url, :reset_time)';
  	 $stmt = $db -> prepare($sql);
  	 $params = array(":reset_url" => $passResetToken, ":reset_time" => $reset_time);
  	 $stmt->execute($params);


  	 mb_language("Japanese");
     mb_internal_encoding("UTF-8");

     mb_send_mail($postdata,"パスワード再設定URL",$reseturlsend);
  	}else{
  		echo "エラー";
      header("Location: login.php");
  		exit;
  	}
  	
   }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>メール認証完了</title>
        <link rel="stylesheet" href="css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
<body>
	<header></header>
	<div class="backmain">
	<div class="group">
		<p style="text-align: center;margin-top: 80px;">メール送信完了</p>
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