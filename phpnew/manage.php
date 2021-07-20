<?php 
session_start();

if(!isset($_SESSION['check'])){
    header("Location: login.php");
}


$dbh = new PDO("mysql:host=localhost; dbname=lunch; charset=utf8", "root", "root");

try{

	$id = $_SESSION['id'];
    
    $sql = "SELECT * FROM user WHERE id = :id";
     $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $member = $stmt->fetch();
  } catch (PDOException $e) {
    $msg = $e->getMessage();
  }





if ($member['role'] == 0) {

try{

    
    $dbh->beginTransaction();

    $sql = "SELECT d.order_id,o.order_time,u.name,u.email,u.address,s.store_name,s.store_address,m.menuename,d.quantity,o.price,o.coupon,d.id
    FROM orders o
    JOIN user u ON o.user_id = u.id
    JOIN store s ON o.store_id = s.id
    JOIN order_detail d ON o.id = d.order_id
    JOIN menue m ON d.menu_id = m.id
    ORDER BY o.order_time DESC";
    
    $statement = $dbh -> query($sql);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$rows[] = $row;
    }
    $dbh->commit();
    
  } catch(PDOException $e){
    $msg = $e->getMessage();
  }
}

if ($member['role'] == 1) {

	try{

    $dbh->beginTransaction();

    $sql = "SELECT d.order_id,o.order_time,u.name,u.email,u.address,s.store_name,s.store_address,m.menuename,d.quantity,o.price,o.coupon,d.id
    FROM orders o
    JOIN user u ON o.user_id = u.id
    JOIN store s ON o.store_id = s.id
    JOIN order_detail d ON o.id = d.order_id
    JOIN menue m ON d.menu_id = m.id
    WHERE o.store_id = 1
    ORDER BY o.order_time DESC";
    
    $statement = $dbh -> query($sql);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$rows[] = $row;
    }
    $dbh->commit();
    
  } catch(PDOException $e){
    $msg = $e->getMessage();
  }
	
}

if ($member['role'] == 2) {

	try{

    $dbh->beginTransaction();

    $sql = "SELECT d.order_id,o.order_time,u.name,u.email,u.address,s.store_name,s.store_address,m.menuename,d.quantity,o.price,o.coupon,d.id
    FROM orders o
    JOIN user u ON o.user_id = u.id
    JOIN store s ON o.store_id = s.id
    JOIN order_detail d ON o.id = d.order_id
    JOIN menue m ON d.menu_id = m.id
    WHERE o.store_id = 2
    ORDER BY o.order_time DESC";
    
    $statement = $dbh -> query($sql);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$rows[] = $row;
    }
    $dbh->commit();
    
  } catch(PDOException $e){
    $msg = $e->getMessage();
  }
	
}

if ($member['role'] == 3) {

	try{

    $dbh->beginTransaction();

    $sql = "SELECT d.order_id,o.order_time,u.name,u.email,u.address,s.store_name,s.store_address,m.menuename,d.quantity,o.price,o.coupon,d.id
    FROM orders o
    JOIN user u ON o.user_id = u.id
    JOIN store s ON o.store_id = s.id
    JOIN order_detail d ON o.id = d.order_id
    JOIN menue m ON d.menu_id = m.id
    WHERE o.store_id = 3
    ORDER BY o.order_time DESC";
    
    $statement = $dbh -> query($sql);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$rows[] = $row;
    }
    $dbh->commit();
    
  } catch(PDOException $e){
    $msg = $e->getMessage();
  }
	
}

if ($member['role'] == 4) {

	try{

    $dbh->beginTransaction();

    $sql = "SELECT d.order_id,o.order_time,u.name,u.email,u.address,s.store_name,s.store_address,m.menuename,d.quantity,o.price,o.coupon,d.id
    FROM orders o
    JOIN user u ON o.user_id = u.id
    JOIN store s ON o.store_id = s.id
    JOIN order_detail d ON o.id = d.order_id
    JOIN menue m ON d.menu_id = m.id
    WHERE o.store_id = 4
    ORDER BY o.order_time DESC";
    
    $statement = $dbh -> query($sql);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$rows[] = $row;
    }
    $dbh->commit();
    //$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $e){
    $msg = $e->getMessage();
  }
	
}


   

  

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/manage.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</head>

<body>

	<h2>予約管理画面</h2><a href="index.php">戻る</a>
  <table class="dbtable">
   <tbody>

	<thead>
		<tr>
			<th>オーダー番号</th>
			<th>注文時間</th>
			<th>氏名</th>
			<th>email</th>
			<th>住所</th>
			<th>店舗名</th>
			<th>店舗住所</th>
			<th>商品名</th>
			<th>個数</th>
			<th>金額</th>
			<th>クーポン</th>
			<th>削除</th>
		</tr>
	</thead>
　　<?php if(isset($rows)) { ?>
	<?php foreach ($rows as $val) :?>	
		<tr>
			<td><?php echo htmlspecialchars($val['order_id']) ?></td>
			<td><?php echo htmlspecialchars($val['order_time']) ?></td>
			<td><?php echo htmlspecialchars($val['name']) ?></td>
			<td><?php echo htmlspecialchars($val['email']) ?></td>
			<td><?php echo htmlspecialchars($val['address']) ?></td>
			<td><?php echo htmlspecialchars($val['store_name']) ?></td>
			<td><?php echo htmlspecialchars($val['store_address']) ?></td>
			<td><?php echo htmlspecialchars($val['menuename']) ?></td>
			<td><?php echo htmlspecialchars($val['quantity']) ?></td>
			<td><?php echo htmlspecialchars($val['price']) ?></td>
			<td><?php echo htmlspecialchars($val['coupon']) ?></td>
			<td><a href="managedelete.php?id=<?php echo $val['id'] ?>" title="" onclick="return confirm('消去しますか？')" class="delete">消去</a></td>
		</tr>
	<?php endforeach ?>
    <?php } ?>

   </tbody>
 </table>
	
	
	
</body>

</html>