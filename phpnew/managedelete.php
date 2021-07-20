<?php session_start();
try{
	$db= new PDO("mysql:dbname=lunch;host=localhost;charset=utf8","root","root");
	$db->beginTransaction();
	$sql = "DELETE FROM lunch.order_detail WHERE id = :id";
	$result = $db -> prepare($sql);
	$result->bindValue(":id",$_GET["id"],PDO::PARAM_INT);
	$result->execute(array(":id"=>$_GET["id"]));

	if(!$result){
		echo $db->error;
		exit();
	}
	$db->commit();
}catch (PDOException $e){
	$db->rollBack();
	echo "接続エラー",$e->getMessage();
}

header("Location: manage.php");
exit();
?>