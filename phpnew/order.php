<?php
session_start();

if(!isset($_SESSION['check'])){
    header("Location: login.php");
}

$username = 'root';
$password = 'root';

if($_POST["select_beef_sand"] == 0 && $_POST["select_salmon_sand"] == 0 && $_POST["select_beef_bowl"] == 0 && $_POST["select_salmon_bowl"] == 0){
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



if(isset($_POST["select_beef_sand"])) {
		$beef_sand = $_POST["select_beef_sand"];

		$beef_sand_amount = $beef_sand * $allRows['0']['price'];
}
if(isset($_POST["select_salmon_sand"])) {
		$salmon_sand = $_POST["select_salmon_sand"];

		$salmon_sand_amount = $salmon_sand * $allRows['1']['price'];
}
if(isset($_POST["select_beef_bowl"])) {
		$beef_bowl = $_POST["select_beef_bowl"];

		$beef_bowl_amount = $beef_bowl * $allRows['2']['price'];
}
if(isset($_POST["select_salmon_bowl"])) {
		$salmon_bowl = $_POST["select_salmon_bowl"];

		$salmon_bowl_amount = $salmon_bowl * $allRows['3']['price'];
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
    			<h1><?php echo $result['0']['store_name'] ;?>/注文確認</h1>
                <?php if($_POST["select_beef_sand"] > 0){ ?>
    			<li>
    				<h2><?php echo $allRows['0']['menuename'] ?>×<?php echo $beef_sand ?></h2>
    				<h2>￥<?php echo $beef_sand_amount;?></h2>
    			</li>	
                <?php }  ;?>
                <?php if($_POST["select_salmon_sand"] > 0){ ?>
    			<li>
    				<h2><?php echo $allRows['1']['menuename'] ?>×<?php echo $salmon_sand ?></h2>
    				<h2>￥<?php echo $salmon_sand_amount; ?></h2>
    			</li>	
                <?php }  ;?>
                <?php if($_POST["select_beef_bowl"] > 0){ ?>
    			<li>
    				<h2><?php echo $allRows['2']['menuename'] ?>×<?php echo $beef_bowl; ?></h2>
    				<h2>￥<?php echo $beef_bowl_amount; ?></h2>
    			</li>
                <?php } ;?>
                <?php if($_POST["select_salmon_bowl"] > 0){ ?>
    			<li>
    				<h2><?php echo $allRows['3']['menuename'] ?>×<?php echo $salmon_bowl; ?></h2>
    				<h2>￥<?php echo $salmon_bowl_amount ?></h2>
    			</li>
                <?php } ;?>
    			<h1>合計￥<?php echo $amount ;?></h1>
    		</ul>
    		<div class="confirm">
    			<button type="submit">注文確定する</button>
    		</div>
    		<div class="back">
    			<a href="index.php">戻る</a>
    		</div>


            <!--まとめて送信は却下
    		<input type="hidden" name="in_roastbeef_sand" value="<?= $allRows['0']['menuename'], '×', $beef_sand, "\n", $allRows['1']['menuename'],  '×', $salmon_sand, "\n", $allRows['2']['menuename'], '×', $beef_bowl, "\n", $allRows['3']['menuename'], '×', $salmon_bowl ;?>">
            -->



            <?php if($_POST["select_beef_sand"] > 0){ ?>
                <input type="hidden" name="roastbeefsand" value="<?= $allRows['0']['id'] ;?>">
                <input type="hidden" name="roastbeefsandquantity" value="<?= $beef_sand ;?>">
            <?php } ?>

            <?php if($_POST["select_salmon_sand"] > 0){ ?>
                <input type="hidden" name="salmonsand" value="<?= $allRows['1']['id'] ;?>">
                <input type="hidden" name="salmonsandquantity" value="<?= $salmon_sand ;?>">
            <?php } ?>

            <?php if($_POST["select_beef_bowl"] > 0){ ?>
                <input type="hidden" name="beefbowl" value="<?= $allRows['2']['id'] ;?>">
                <input type="hidden" name="beefbowlquantity" value="<?= $beef_bowl ;?>">
            <?php } ?>

            <?php if($_POST["select_salmon_bowl"] > 0){ ?>
                <input type="hidden" name="salmonbowl" value="<?= $allRows['3']['id'] ;?>">
                <input type="hidden" name="salmonbowlquantity" value="<?= $salmon_bowl ;?>">
            <?php } ?>



            <!--上に全て格納
            <input type="hidden" name="in_smoaksalmon_sand" value="<?= $allRows['1']['menuename'], '×', $salmon_sand ;?>">
            <input type="hidden" name="in_roastbeef_bowl" value="<?= $allRows['2']['menuename'], '×', $beef_bowl ;?>">
            <input type="hidden" name="in_smoaksalmon_bowl" value="<?= $allRows['3']['menuename'], '×', $salmon_bowl ;?>">
            -->
            <input type="hidden" name="in_amount" value="<?= $amount ;?>">

            <input type="hidden" name="store" value="<?= $result['0']['id'] ;?>">
            
    	</form>
    </div>

    <footer></footer>

</body>
</html>