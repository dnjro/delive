<?php
session_start();

if(!isset($_SESSION['check'])){
    header("Location: login.php");
}

$username = 'root';
$password = 'root';

if($_POST["select_flybowl"] == 0 && $_POST["select_fly"] == 0 && $_POST["select_coldnoodle"] == 0 && $_POST["select_hotnoodle"] == 0){
    header('Location:index.php');
}

$dbh = new PDO("mysql:host=localhost; dbname=lunch; charset=utf8", $username, $password);

try{

    $dbh;

    $sql = "SELECT *
            FROM menue";
    $statement = $dbh -> query($sql);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $allRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e){
    $msg = $e->getMessage();
}


if(isset($_POST["select_flybowl"])) {
		$beef_sand = $_POST["select_flybowl"];

		$beef_sand_amount = $beef_sand * $allRows['8']['price'];
}
if(isset($_POST["select_fly"])) {
		$salmon_sand = $_POST["select_fly"];

		$salmon_sand_amount = $salmon_sand * $allRows['9']['price'];
}
if(isset($_POST["select_coldnoodle"])) {
		$beef_bowl = $_POST["select_coldnoodle"];

		$beef_bowl_amount = $beef_bowl * $allRows['10']['price'];
}
if(isset($_POST["select_hotnoodle"])) {
		$salmon_bowl = $_POST["select_hotnoodle"];

		$salmon_bowl_amount = $salmon_bowl * $allRows['11']['price'];
}

$amount = $beef_sand_amount + $salmon_sand_amount + $beef_bowl_amount + $salmon_bowl_amount;


try{

    $dbh;

    $sql = "SELECT *
            FROM store";
    $statement = $dbh -> query($sql);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e){
    $msg = $e->getMessage();
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>colorchart</title>
  <link rel="stylesheet" type="text/css" href="css/order.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
</head>
<body>


    <header></header>

    <div class="main">
    	<form class="group" action="ordercompleat.php" method="POST">
    		<ul>
    			<h1><?php echo $result['2']['store_name'] ?>/注文確認</h1>
                <?php if($_POST["select_flybowl"] > 0){ ?>
    			<li>
    				<h2><?php echo $allRows['8']['menuename'] ?>×<?php echo $beef_sand ?></h2>
    				<h2>￥<?php echo $beef_sand_amount;?></h2>
    			</li>	
                <?php } ?>
                <?php if($_POST["select_fly"] > 0){ ?>
    			<li>
    				<h2><?php echo $allRows['9']['menuename'] ?>×<?php echo $salmon_sand ?></h2>
    				<h2>￥<?php echo $salmon_sand_amount; ?></h2>
    			</li>	
                <?php } ?>
                <?php if($_POST["select_coldnoodle"] > 0){ ?>
    			<li>
    				<h2><?php echo $allRows['10']['menuename'] ?>×<?php echo $beef_bowl; ?></h2>
    				<h2>￥<?php echo $beef_bowl_amount; ?></h2>
    			</li>
                <?php } ?>
                <?php if($_POST["select_hotnoodle"] > 0){ ?>
    			<li>
    				<h2><?php echo $allRows['11']['menuename'] ?>×<?php echo $salmon_bowl; ?></h2>
    				<h2>￥<?php echo $salmon_bowl_amount ?></h2>
    			</li>
                <?php } ?>
    			<h1>合計￥<?php echo $amount ;?></h1>
    		</ul>
    		<div class="confirm">
    			<button type="submit">注文確定する</button>
    		</div>
    		<div class="back">
    			<a href="index.php">戻る</a>
    		</div>
    		

            <?php if($_POST["select_flybowl"] > 0){ ?>
                <input type="hidden" name="roastbeefsand" value="<?= $allRows['8']['id'] ;?>">
                <input type="hidden" name="roastbeefsandquantity" value="<?= $beef_sand ;?>">
            <?php } ?>

            <?php if($_POST["select_fly"] > 0){ ?>
                <input type="hidden" name="salmonsand" value="<?= $allRows['9']['id'] ;?>">
                <input type="hidden" name="salmonsandquantity" value="<?= $salmon_sand ;?>">
            <?php } ?>

            <?php if($_POST["select_coldnoodle"] > 0){ ?>
                <input type="hidden" name="beefbowl" value="<?= $allRows['10']['id'] ;?>">
                <input type="hidden" name="beefbowlquantity" value="<?= $beef_bowl ;?>">
            <?php } ?>

            <?php if($_POST["select_hotnoodle"] > 0){ ?>
                <input type="hidden" name="salmonbowl" value="<?= $allRows['11']['id'] ;?>">
                <input type="hidden" name="salmonbowlquantity" value="<?= $salmon_bowl ;?>">
            <?php } ?>


            <input type="hidden" name="in_amount" value="<?= $amount ;?>">
            <input type="hidden" name="store" value="<?= $result['2']['id'] ;?>">
            
    	</form>
    </div>

    <footer></footer>

</body>
</html>