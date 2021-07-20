<?php 
session_start();

// if(isset($_GET['passRset'])){
	//echo $_GET['passRset'];
// }

$getreset = $_GET['passRset'];

$db= new PDO("mysql:dbname=lunch;host=localhost;charset=utf8","root","root");
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM para WHERE reset_url = :reset_url";

$token = array(":reset_url" => $getreset);

$stmt = $db->prepare($sql);
$stmt->execute($token);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if(empty($data)){
	echo 'エラー';
	exit;
}else{
	$limitTime = date("Y-m-d H:i:s", strtotime("-10 minute"));
	//echo $limitTime;
}



/*if($data["reset_time"] >= $limitTime){
	//return array('true',$data['id']);
	echo 'セーフ';
}else{
	//return array('false',$data['id']);
	echo '時間切れ';
}*/

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>パスワード変更画面</title>
        <link rel="stylesheet" href="css/login.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>


    <?php

    $mailError = $passError = $confpassError ="";
    $error = array();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $pMail = $_POST["email"];
      $pPass = $_POST["pass"];
      $pconfpass = $_POST["comfpass"];


      if(empty($pMail) || !filter_var($pMail,FILTER_VALIDATE_EMAIL)){
        $error[] = $mailError = "メールアドレスは正しくご入力ください";
        
      }else{
        $_SESSION["email"] = $pMail;
      }

      if(empty($pPass)){
        $error[] = $passError = "パスワードを正しく入力してください";
      }else{
        $_SESSION["pass"] = $pPass;
      }

      if($pPass !== $pconfpass){

        $error[] = $confpassError = '設定したパスワードと確認パスワードが一致しません';
      }else{
        $_SESSION["comfpass"] = $pconfpass;
      }

      if(empty($error)){
        $_SESSION["validation"] = 1;
        header("location: passresetform_comp.php");
        exit();
      }


    };
    $errorJson = json_encode($error);
  ?>

  <script>
    $(function(){
      var $error = <?php echo $errorJson ?>;
      if($error.length >= 1){
        confirm($error.join("\n"));

      }
    });

    
  </script>
<body>
	<?php if($data["reset_time"] >= $limitTime) { ?>
	<header></header>
	<div class="backmain">
	<div class="group">
		
	<div class="logingroup">
		<p style="text-align: center;margin-top: 15px;">新しいパスワードを設定してください</p>
		<form ction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, 'UTF-8');?>" method="post"accept-charset="utf-8" onsubmit="return pre()">
	    	<p class="mail">
	    		<label for="email">メールアドレス</label>
	    		<input type="text" name="email" value="<?php if(isset($_SESSION['email'])){ echo htmlspecialchars($_SESSION['email']);} ?>">
	    		<?php if(isset($mailError)): ?>
                  <p style="color: red"><?php echo $mailError; ?></p>
                <?php endif ?>
	    	</p>
	    	<p class="mail">
	    		<label for="pass">新しいパスワード</label>
	    		<input type="password" name="pass">
	    		<?php if(isset($passError)): ?>
                  <p style="color: red"><?php echo $passError; ?></p>
                <?php endif ?>
	    	</p>
	    	<p class="mail">
	    		<label for="comfpass">確認用パスワード</label>
	    		<input type="password" name="comfpass">
	    		<?php if(isset($confpassError)): ?>
                  <p style="color: red"><?php echo $confpassError; ?></p>
                <?php endif ?>
	    	</p>
           <div class="button">
	    	<input type="submit" name="ログイン">
	       </div>
	    </form>
	</div>
	<div class="button">
	  <a href="login.php">ログイン画面へ戻る</a>
    </div> 
    </div>
    </div>
    <footer></footer>
    <?php } ; ?>





    

  <?php if ($data["reset_time"] <= $limitTime) { ?>
    	<header></header>
	<div class="backmain">
	<div class="group">
		<p style="text-align: center;margin-top: 15px;">urlの有効期限が切れています。初めからやり直してください</p>
	<div class="logingroup">
	</div>
	<div class="button">
	  <a href="login.php">ログイン画面へ戻る</a>
    </div> 
    </div>
    </div>
    <footer></footer>
  <?php } ?>

    
</body>
</html>






