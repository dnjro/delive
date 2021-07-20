<?php session_start(); 

 if($_SESSION["validation"] !=1){
	$_SESSION["validation"]=0;
	header("Location: login.php");
 }else{
 	$_SESSION["validation"] = 0;
 }
 


$dsn = "mysql:host=localhost; dbname=lunch; charset=utf8";
$usermail = "root";
$password = "root";



try{
    $dbh = new PDO($dsn, $usermail, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    
}

$sql = "SELECT * FROM user WHERE email = :email";
$params = array(":email" => $_SESSION['mail']);

$stmt = $dbh->prepare($sql);
//$stmt->bindValue(':email', $mail);
$stmt->execute($params);
$member = $stmt->fetch();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['mailerror'] = '登録済みのアドレスです';

if(!empty($member)){
	echo $_SESSION['mailerror'];
	header('Location: register.php');
}

 



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/confirm.css">
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
	   if($_SERVER["REQUEST_METHOD"] == "POST"){
	   	    if(isset($_POST["back"])){
	   	     	$_SESSION["num"] = 2;
	   		    header("Location: register.php");
	   	    }else if(isset($_POST["send"])){
	   		    $_SESSION["validation"] = 2;
	   		    header("Location: compleat.php");
	   	    }
	    }
	?>

	<header></header>


	
	<div class="back">
		<div class="confirmgroup">
			<div class="toiawase">
				<p class="toiawasepp">新規登録</p>
			</div>
			<div class="ulgroup">
				<p class="ulp">下記の内容をご確認の上登録ボタンを押してください<br>内容を訂正する場合は戻るを押してください。</p>
				<ul class="ul">
					<li>
						<p>氏名</p>
						<h1><?php echo htmlspecialchars($_SESSION["name1"])?></h1>
					</li>

					<li>
						<p>メールアドレス</p>
						<h1><?php echo htmlspecialchars($_SESSION["mail"])?></h1>
					</li>

					<li>
						<p>住所</p>
						<h1><?php echo htmlspecialchars($_SESSION["address"]) ?></h1>
					</li>

					<li>
						<p>パスワード</p>
						<h1><?php echo htmlspecialchars($_SESSION["pass"])?></h1>
					</li>

					<li>
						<p>確認用パスワード</p>
						<h1><?php echo htmlspecialchars($_SESSION["confpass"])?></h1>
					</li>

					

					<li class="buttonsubmit">
					   <form name="send" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, 'UTF-8');?>" method="post" accept-charset="utf-8">
						<input name="send" type="submit" value="登録" class="soushinn">
					   </form>
					   
					   <form  name="back" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, 'UTF-8');?>" method="post" accept-charset="utf-8">
						<input name="back" type="submit" class="modoru" value="戻る" onclick="history.back()">
					   </form>
					   
					</li>
				</ul>
			</div>
		</div>
	</div>

	<footer></footer>
	
	
</body>
</html>