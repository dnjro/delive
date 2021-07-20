<?php
session_start();
$error = $_SESSION;

$loginerror = isset($_SESSION['loginerror']) ? $_SESSION['loginerror']: null;
unset($_SESSION['loginerror']);

$_SESSION = array();
session_destroy();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ログイン</title>
        <link rel="stylesheet" href="css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
<body>
	<header></header>
	<div class="backmain">
	<div class="group">
	<div class="logingroup">
		<h2>ログイン</h2>

		<?php if(isset($loginerror)): ?>
			<p style="color: red"><?php echo $loginerror; ?></p>
	    <?php endif; ?>

	    <?php if(isset($error['match'])): ?>
	    <p style="color: red"><?php echo $error['match']; ?></p>
	    <?php endif; ?>

	    <form action="logincompleat.php" method="POST">
	    	<p class="mail">
	    		<label for="email">メールアドレス</label>
	    		<input type="text" name="email">
	    		<?php if(isset($error['email'])): ?>
	    			<p style="color: red"><?php echo $error['email']; ?></p>
	    		<?php endif; ?>
	    	</p>
	    	<p class="mail">
	    		<label for="password">パスワード</label>
	    		<input type="password" name="pass">
	    		<?php if(isset($error['password'])): ?>
	    			<p style="color: red"><?php echo $error['password']; ?></p>
	    		<?php endif; ?>
	    	</p>
           <div class="button">
	    	<input type="submit" name="ログイン">
	       </div>
	    </form>
	</div>
	<div class="button">
	  <a href="register.php">新規登録はこちら</a>
    </div> 
    <div class="button">
    	<a href="passreset.php">パスワードを忘れた方はこちら</a>
    </div>
    </div>
    </div>
    <footer></footer>
</body>
</html>