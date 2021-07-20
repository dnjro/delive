<?php 
session_start();

if(!isset($_SESSION['check'])){
    header("Location: login.php");
}

$user = 'root';
$password = 'root';
$dbname = 'lunch';
$host = 'localhost:3306';
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

$five = "500yenOff!!";
$four = "400yenOff!!";
$three = "300yenOff!";
$two = "200yenOff";
$one = "100yenOff!";
$none = "";

if($_POST['in_amount'] >= 4000){
  $int = rand(0,10);

  if($int == 10 || $int == 9 || $int == 8 || $int == 7) {
    $ran = $five;
  }elseif($int == 6 || $int == 5){
    $ran = $four;
  }elseif($int == 4 || $int == 3){
    $ran = $three;
  }elseif($int == 2 || $int == 1){
    $ran = $two;
  }elseif($int == 0){
    $ran = $none;
  }
}elseif($_POST['in_amount'] >= 3000 && $_POST['in_amount'] < 4000){
  $int = rand(0,10);

  if($int == 10 || $int == 9 || $int == 8) {
    $ran = $five;
  }elseif($int == 7 || $int ==6){
    $ran = $three;
  }elseif($int == 5){
    $ran = $one;
  }else{
    $ran = $none;
  }
}elseif($_POST['in_amount'] >= 2000 && $_POST['in_amount'] < 3000){
  $int = rand(0,10);

  if($int == 10) {
    $ran = $one;
  }elseif($int == 9){
    $ran = $one;
  }elseif($int == 8){

    $ran = $three;

  }elseif($int == 7){
    $ran = $one;
  }elseif($int == 6){
    $ran = $five;
  }else{
    $ran = $none;
  }
}elseif($_POST['in_amount'] >= 1000 && $_POST['in_amount'] < 2000){
  $int = rand(0,10);

  if($int == 10 || $int == 9 || $int == 8 || $int == 7) {
    $ran = $one;
  }else{
    $ran = $none;
  }
}elseif($_POST['in_amount'] >= 400 && $_POST['in_amount'] < 1000){
  $int = rand(0,10);


  if($int == 10 || $int == 9 || $int == 8) {
    $ran = $one;
  }else{
    $ran = $none;
  }
}elseif($_POST['in_amount'] < 400){
  $int = rand(0,10);

  if($int == 10 || $int == 9) {
    $ran = $one;
  }else{
   $ran = $none;
  }
}

  $db= new PDO("mysql:dbname=$dbname;host=localhost;charset=utf8","$user","$password");
  $dbstart =  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbfalse =  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

 //注文ユーザid,合計金額,クーポン,店舗idをインサート

 try{
    $db;
    $dbstart;
    $dbfalse;
    
  
    $coupon = $ran;

    $store = $_POST["store"];

    $amount = $_POST['in_amount'];

    $id = $_SESSION['id'];

    

    $sql = 'INSERT INTO orders (user_id, price, coupon, store_id) VALUES (:user_id, :price, :coupon, :store_id)';
    $stmt = $db->prepare($sql);
    $params = array(":user_id" => $id, ":price" => $amount, ":coupon" => $ran, ":store_id" => $store);
    $stmt->execute($params);
  }catch (PDOException $e) {
    echo "接続エラー",$e->getMessage();
  }


  //ordersテーブルのmaxidを取得
  try{
    $db;
    $sql = "SELECT MAX(id) as mx
            FROM orders";
    $statement = $db -> query($sql);
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e){
    $msg = $e->getMessage();
  }

  //order_detailテーブルにorder_id,menu_id,amountをインサート
  try{
    $db;
    $dbstart;
    $dbfalse;
    
    if(isset($_POST['roastbeefsandquantity'])){

      $sql = 'INSERT INTO order_detail (order_id, menu_id, quantity) VALUES (:order_id, :menu_id, :quantity)';

      $menu = $_POST['roastbeefsand'];
      $quantity = $_POST['roastbeefsandquantity'];
      $maxid = $result['0']['mx'];
      $stmt = $db->prepare($sql);

      $stmt->bindValue(":order_id", $maxid);
     $stmt->bindValue(":menu_id", $menu);
     $stmt->bindValue(":quantity", $quantity);
     $stmt->execute();
    }

    if(isset($_POST['salmonsandquantity'])){

      $sql = 'INSERT INTO order_detail (order_id, menu_id, quantity) VALUES
      (:order_id1, :menu_id1, :quantity1)';

      $menu1 = $_POST['salmonsand'];
      $quantity1 = $_POST['salmonsandquantity'];
      $maxid1 = $result['0']['mx'];
      $stmt = $db->prepare($sql);

      $stmt->bindValue(":order_id1", $maxid1);
     $stmt->bindValue(":menu_id1", $menu1);
     $stmt->bindValue(":quantity1", $quantity1);
     $stmt->execute();
    }

    if(isset($_POST['beefbowlquantity'])){

      $sql = 'INSERT INTO order_detail (order_id, menu_id, quantity) VALUES
      (:order_id2, :menu_id2, :quantity2)';


      $menu2 = $_POST['beefbowl'];
      $quantity2 = $_POST['beefbowlquantity'];
      $maxid2 = $result['0']['mx'];
      $stmt = $db->prepare($sql);

      $stmt->bindValue(":order_id2", $maxid2);
     $stmt->bindValue(":menu_id2", $menu2);
     $stmt->bindValue(":quantity2", $quantity2);
     $stmt->execute();
    }

    if(isset($_POST['salmonbowlquantity'])){

      $sql = 'INSERT INTO order_detail (order_id, menu_id, quantity) VALUES 
      (:order_id3, :menu_id3, :quantity3)';

      $menu3 = $_POST['salmonbowl'];
      $quantity3 = $_POST['salmonbowlquantity'];
      $maxid3 = $result['0']['mx'];
      $stmt = $db->prepare($sql);

      $stmt->bindValue(":order_id3", $maxid3);
     $stmt->bindValue(":menu_id3", $menu3);
     $stmt->bindValue(":quantity3", $quantity3);
     $stmt->execute();
    }
  }catch (PDOException $e) {
    echo "接続エラー",$e->getMessage();
  }finally{
    $db = null;
  }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>ordercomplete</title>
  <link rel="stylesheet" type="text/css" href="css/ordercompleat.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</head>
<body>
	<header></header>

	<div class="group">
		<div>
			<h1>Thanks for your order</h1>
		</div>
		<div class="atag"><a href="index.php">top</a></div>
		<div class="ran"><?php echo $ran ;?></div>
	</div>
  
	<footer></footer>
</body>
</html>
