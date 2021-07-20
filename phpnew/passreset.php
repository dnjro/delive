<?php 
 session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>パスワードリセット</title>
        <link rel="stylesheet" href="css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
<body>
	<header></header>
	<div class="backmain">
	<div class="group">
	<div class="logingroup">
		<h2>登録済みのメールアドレスを入力してください</h2>

		<?php if(isset($loginerror)): ?>
			<p style="color: red"><?php echo $loginerror; ?></p>
	    <?php endif; ?>

	    <form action="passresetcompleat.php" method="POST">
	    	<p class="mail">
	    		<label for="email">メールアドレス</label>
	    		<input type="text" name="email">
	    		<?php if(isset($error['email'])): ?>
	    			<p style="color: red"><?php echo $error['email']; ?></p>
	    		<?php endif; ?>
	    	</p>
           <div class="button">
	    	<input type="submit" name="ログイン">
	       </div>
	    </form>
	</div>
	<div class="button">
	  <a href="login.php">戻る</a>
    </div> 
    </div>
    </div>
    <footer></footer>
</body>
</html>