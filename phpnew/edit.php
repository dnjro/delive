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


$nameError =  $mailError = $addressError = $passError = $confpassError = "";
    $error = array();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $pName = $_POST["name"];
      $pMail = $_POST["mail"];
      $pPass = $_POST["pass"];
      $pconfpass = $_POST["confpass"];
      $pAddress = $_POST["address"];

      if(empty($pName) || mb_strlen($pName) > 10){
        $error[] = $nameError = "氏名は必須入力です 10文字以内で入力してください";
      }else{
        $_SESSION["name1"] = $pName;
      };


      if(empty($pMail) || !filter_var($pMail,FILTER_VALIDATE_EMAIL)){
        $error[] = $mailError = "メールアドレスは正しくご入力ください";
        
      }else{
        $_SESSION["email"] = $pMail;
      }

      if(empty($pAddress)){
        $error[] = $addressError = "住所は入力必須です";
      }else{
        $_SESSION["address"] = $pAddress;
      }

      if(empty($pPass)){
        $error[] = $passError = "パスワードを正しく入力してください";
      }else{
        $_SESSION["pass"] = $pPass;
      }

      if($pPass !== $pconfpass){

        $error[] = $confpassError = '設定したパスワードと確認パスワードが一致しません';
      }else{
        $_SESSION["confpass"] = $pconfpass;
      }


      if(empty($error)){
        $_SESSION["validation"] = 1;
        header("location: editconfirm.php");
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


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>edit</title>
  <link rel="stylesheet" type="text/css" href="css/edit.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
  	
  </script>
</head>
<body>
  <header></header>
  <div class="backphoto">
  <div class="space">
	<form class="page" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"],ENT_QUOTES, 'UTF-8');?>" method="post" accept-charset="utf-8" onsubmit="return pre()">
		<h1>登録情報変更</h1>
    <div>
      <ul class="ulgroup">
        <li>
          <p>氏名</p>
          <input type="text" name="name" value="<?php if(isset($member['name'])){echo htmlspecialchars($member['name']);}elseif(isset($_SESSION['name1'])) {echo htmlspecialchars($_SESSION['name1']);} ?>">
          <p>
            <?php if(isset($nameError)): ?>
              <?php echo $nameError; ?>
            <?php endif ?>
          </p>
        </li>

        <li>
          <p>メールアドレス</p>
          <input type="text" name="mail" value="<?php if(isset($member['email'])){echo htmlspecialchars($member['email']);}elseif(isset($_SESSION['email'])) {echo htmlspecialchars($_SESSION['email']);} ?>">
          <p>
            <?php if(isset($emailError)): ?>
              <?php echo $emailError; ?>
            <?php endif ?>
          </p>
        </li>

        <li>
          <p>住所</p>
          <input type="text" name="address" value="<?php if(isset($member['address'])){echo htmlspecialchars($member['address']);}elseif(isset($_SESSION['address'])) {echo htmlspecialchars($_SESSION['address']); } ?>">
          <p>
            <?php if(isset($addressError)): ?>
              <?php echo $addressError ;?>
            <?php endif ?>
          </p>
        </li>

        <li>
          <p>パスワード</p>
          <input type="password" name="pass" value="<?php if(isset($data['pass'])){echo htmlspecialchars($data['pass']);}elseif(isset($_SESSION['pass'])) {echo htmlspecialchars($_SESSION['pass']);} ?>">
          <p>
            <?php if(isset($passError)): ?>
              <?php echo $passError; ?>
            <?php endif ?>
          </p>
        </li>
        <li>
          <p>確認用パスワード</p>
          <input type="password" name="confpass" value="<?php if(isset($data['pass'])){echo htmlspecialchars($data['pass']);}elseif(isset($_SESSION['confpass'])) {echo htmlspecialchars($_SESSION['confpass']);} ?>">
          <p>
            <?php if(isset($confpassError)): ?>
              <?php echo $confpassError; ?>
            <?php endif ?>
          </p>
        </li>
      </ul>
    </div>
    <div class="confirm">
      <button type="submit">確認</button>
    </div>
    <div class="confirm">
   <a href="index.php">topへ戻る</a>
  </div>
	</form> 
  </div>
  </div>
  <footer></footer>
  
</body>
</html>