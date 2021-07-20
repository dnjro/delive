<?php session_start();

if(!isset($_SESSION['check'])){
    header("Location: login.php");
}

$id = $_SESSION['id'];
$dsn = "mysql:host=localhost; dbname=lunch; charset=utf8";
$username = "root";
$password = "root";

try{
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}

$sql = "SELECT * FROM user WHERE id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->execute();
$member = $stmt->fetch();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>colorchart</title>
  <link rel="stylesheet" type="text/css" href="css/mypage.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
  	
  </script>
</head>
<body>
  <header></header>
  <div class="backphoto">
  <div class="pagegroup">
	<div class="page">
		<h1>登録情報</h1>
    <div>
      <ul class="ulgroup">
        <li>
          <p>氏名</p>
          <h2><?php echo htmlspecialchars($member["name"])?></h2>
        </li>

        <li>
          <p>メールアドレス</p>
          <h2><?php echo htmlspecialchars($member["email"])?></h2>
        </li>

        <li>
          <p>住所</p>
          <h2><?php echo htmlspecialchars($member["address"]) ?></h2>
        </li>
         <div class="confirm">
    <a href="edit.php">変更画面へ進む</a>
  </div>
  <div class="confirm">
    <a href="index.php">topに戻る</a>
  </div>
      </ul>
    </div>
	</div>
  </div>
  </div>
  <footer></footer>


  
  
</body>
</html>