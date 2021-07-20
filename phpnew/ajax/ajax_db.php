<?php 


try{

    $dbh = new PDO("mysql:host=localhost; dbname=lunch; charset=utf8", 'root', 'root');

    $sql = "SELECT *
            FROM menue";
    $statement = $dbh -> query($sql);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $allRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e){
    $msg = $e->getMessage();
}

if(isset($_GET['no'])){

$beef_sand_amount = $_GET['no'] * $allRows['0']['price'];

echo "¥".$beef_sand_amount;
}




if(isset($_GET['no1'])){

$beef_sand_amount = $_GET['no1'] * $allRows['1']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no2'])){

$beef_sand_amount = $_GET['no2'] * $allRows['2']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no3'])){

$beef_sand_amount = $_GET['no3'] * $allRows['3']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no4'])){

$beef_sand_amount = $_GET['no4'] * $allRows['4']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no5'])){

$beef_sand_amount = $_GET['no5'] * $allRows['5']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no6'])){

$beef_sand_amount = $_GET['no6'] * $allRows['6']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no7'])){

$beef_sand_amount = $_GET['no7'] * $allRows['7']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no8'])){

$beef_sand_amount = $_GET['no8'] * $allRows['8']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no9'])){

$beef_sand_amount = $_GET['no9'] * $allRows['9']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no10'])){

$beef_sand_amount = $_GET['no10'] * $allRows['10']['price'];

echo "¥".$beef_sand_amount;
}

if(isset($_GET['no11'])){

$beef_sand_amount = $_GET['no11'] * $allRows['11']['price'];

echo "¥".$beef_sand_amount;
}


?>