<?php session_start(); 

 if($_SESSION["validation"] !=1){
	$_SESSION["validation"]=0;
	header("Location: login.php");
 }else{
 	$_SESSION["validation"] = 0;
 }
 
 

 



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>cafe</title>
  <link rel="stylesheet" type="text/css" href="css/editconfirm.css">
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

	<header></header>
	<div class="backphoto">
	<?php
	   if($_SERVER["REQUEST_METHOD"] == "POST"){
	   	    if(isset($_POST["back"])){
	   	     	$_SESSION["num"] = 2;
	   		    header("Location: edit.php");
	   	    }else if(isset($_POST["send"])){
	   		    $_SESSION["validation"] = 2;
	   		    header("Location: editcompleat.php");
	   	    }
	    }
	?>


	
	<div class="space">
		<div class="confirmgroup">
			<div class="toiawase">
				<p class="toiawasepp">登録内容編集</p>
			</div>
			<div class="ulgroup">
				<p class="ulp">下記の内容をご確認の上編集ボタンを押してください<br>内容を訂正する場合は戻るを押してください。</p>
				<ul class="ul">
					<li>
						<p>氏名</p>
						<h2><?php echo htmlspecialchars($_SESSION["name1"])?></h2>
					</li>

					<li>
						<p>メールアドレス</p>
						<h2><?php echo htmlspecialchars($_SESSION["email"])?></h2>
					</li>

					<li>
						<p>住所</p>
						<h2><?php echo htmlspecialchars($_SESSION["address"]) ?></h2>
					</li>

					<li>
						<p>パスワード</p>
						<h2><?php echo htmlspecialchars($_SESSION["pass"])?></h2>
					</li>

					<li>
						<p>確認用パスワード</p>
						<h2><?php echo htmlspecialchars($_SESSION["confpass"])?></h2>
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
 
    </div>
    <footer></footer>
</body>
</html>