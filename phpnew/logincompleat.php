<?php
session_start();

$error = [];

if(!$email = filter_input(INPUT_POST, 'email')){
	$error['email'] = 'メールアドレスを入力してください';
}
if(!$password = filter_input(INPUT_POST, 'pass')){
	$error['password'] = 'パスワードを入力してください';
}

if(count($error) > 0){
	$_SESSION = $error;
	header('Location: login.php');
	return;
}


$mail = $_POST['email'];
$dsn = "mysql:host=localhost; dbname=lunch; charset=utf8";
$usermail = "root";
$password = "root";



try{
    $dbh = new PDO($dsn, $usermail, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
    
}

$sql = "SELECT * FROM user WHERE email = :email";
$params = array(":email" => $_POST['email']);

$stmt = $dbh->prepare($sql);
//$stmt->bindValue(':email', $mail);
$stmt->execute($params);
$member = $stmt->fetch();
$data = $stmt->fetch(PDO::FETCH_ASSOC);





if(!isset($member['email'])){
    $msg = 'メールアドレスもしくはパスワードが間違えています';
    $link = '<a href="login.php">戻る</a>';
    
}
elseif(password_verify($_POST['pass'], $member['pass'])){
    $_SESSION['id'] = $member['id'];
    $_SESSION['email'] = $member['email'];
    $_SESSION['check'] = 1;
    header("Location: index.php");
    return true;
}else{
    $msg = 'メールアドレスもしくはパスワードが間違えています';
    $link = '<a href="login.php">戻る</a>';
}




?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>完了画面</title>
	<link rel="stylesheet" type="text/css" href="css/logincompleat.css">
	<script type="text/javascript"></script>
</head>
<body>
	
    <header></header>

    <div class="main">

    <h2 style="text-align: center;  "><?php echo $msg; ?></h2>
    <p style="text-align: center;"><?php echo $link; ?></p>

    </div>

    <footer></footer>

</body>
</html>
