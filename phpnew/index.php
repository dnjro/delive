<?php session_start();



$username = 'root';
$passwsord = 'root';

$dbh = new PDO("mysql:host=localhost; dbname=lunch; charset=utf8", $username, $passwsord);


try{
    $dbh;
    $sql = "SELECT * 
        FROM menue";

    $statement = $dbh -> query($sql);

    $row_count = $statement->rowCount();


	$stmt = $dbh->prepare($sql);
	$stmt->execute();
  $allRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
} catch (PDOException $e) {
    $msg = $e->getMessage();
}


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


//↓role処理のためのユーザー情報取得

$id = $_SESSION['id'];



try{
    $dbh;
    $sql = "SELECT * FROM user WHERE id = :id";
     $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $member = $stmt->fetch();
  } catch (PDOException $e) {
    $msg = $e->getMessage();
  }




if(!isset($_SESSION['check'])){
  header("Location: login.php");
}


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>order</title>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

  <script>
  </script>
</head>
<body>
 
  <?php if($member['role'] == 100){  ?>
  
  <div class="titleback">
	<div class="titlegroup">
		<p class="title">OrderPage</p>
		<div>
		  <a href="mypage.php">mypage</a>
      <a href="login.php">/ログアウト</a>
	  </div>
	</div>
  </div>
  <div class="space">
    
  </div>
  <form action="order.php" method="POST">
  <div class="image">
	<div class="colorcircle">
    <h2><?php echo $result['0']['store_name'] ?>
    <?php echo $result['0']['store_address'] ?></h2>
		<ul class="colorchart" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/ba2.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['0']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['0']['price'] ?>&nbsp;×&nbsp;<select class="select" name="select_beef_sand">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button1"><p class="result"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button1').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no : $('.select').val()
              }
            }).done(function(data){
              $('.result').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>


      <li>
        <img src="photo/ba1.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['1']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['1']['price'] ?>&nbsp;×&nbsp;<select class="select1" name="select_salmon_sand">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button2"><p class="result1"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button2').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no1 : $('.select1').val()
              }
            }).done(function(data){
              $('.result1').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
		</ul>


    <ul class="ulrice" id="idcolorchart" style="opacity: 0.8">
      <li>
        <img src="photo/rice1.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['2']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['2']['price'] ?>&nbsp;×&nbsp;<select class="select2" name="select_beef_bowl">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button3"><p class="result2"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button3').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no2 : $('.select2').val()
              }
            }).done(function(data){
              $('.result2').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>


      <li>
        <img src="photo/rice2.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['3']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['3']['price'] ?>&nbsp;×&nbsp;<select class="select3" name="select_salmon_bowl">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button4"><p class="result3"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button4').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no3 : $('.select3').val()
              }
            }).done(function(data){
              $('.result3').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
    </ul>
	</div> 
  </div>
  <div class="space1">
    <div class="button"><button type="submit" >注文確認へ</button></div>
  </div>
  </form>


  <form action="ordernoodle.php" method="POST">
  <div class="image">
  <div class="colorcircle">
    <h2><?php echo $result['1']['store_name'] ?>
    <?php echo $result['1']['store_address'] ?></h2>
    <ul class="colorchart" id="idcolorchart" style="opacity: 0.8">
      <li>
        <img src="photo/noodle1.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['4']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['4']['price'] ?>&nbsp;×&nbsp;<select class="select4" name="select_noodle1">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button5"><p class="result4"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button5').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no4 : $('.select4').val()
              }
            }).done(function(data){
              $('.result4').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>

      <li>
        
        <img src="photo/noodle2.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['5']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['5']['price'] ?>&nbsp;×&nbsp;<select class="select5" name="select_noodle2">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button6"><p class="result5"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button6').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no5 : $('.select5').val()
              }
            }).done(function(data){
              $('.result5').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      
    </ul>
    <ul class="ulrice" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/noodle3.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['6']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['6']['price'] ?>&nbsp;×&nbsp;<select class="select6" name="select_noodle3">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button7"><p class="result6"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button7').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no6 : $('.select6').val()
              }
            }).done(function(data){
              $('.result6').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/noodle4.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['7']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['7']['price'] ?>&nbsp;×&nbsp;<select class="select7" name="select_noodle4">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button8"><p class="result7"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button8').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no7 : $('.select7').val()
              }
            }).done(function(data){
              $('.result7').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
    </ul>
  </div> 
  </div>
  <div class="space1">
    <div class="button"><button type="submit" >注文確認へ</button></div>
  </div>
  </form>


  <form action="orderfly.php" method="POST">
  <div class="image">
  <div class="colorcircle">
    <h2><?php echo $result['2']['store_name'] ?>
    <?php echo $result['2']['store_address'] ?></h2>
    <ul class="colorchart" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/flybowl.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['8']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['8']['price'] ?>&nbsp;×&nbsp;<select class="select8" name="select_flybowl">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button9"><p class="result8"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button9').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no8 : $('.select8').val()
              }
            }).done(function(data){
              $('.result8').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/fly.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['9']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['9']['price'] ?>&nbsp;×&nbsp;<select class="select9" name="select_fly">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button10"><p class="result9"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button10').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no9 : $('.select9').val()
              }
            }).done(function(data){
              $('.result9').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      
    </ul>
    <ul class="ulrice" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/coldnoodle.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['10']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['10']['price'] ?>&nbsp;×&nbsp;<select class="select10" name="select_coldnoodle">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button11"><p class="result10"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button11').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no10 : $('.select10').val()
              }
            }).done(function(data){
              $('.result10').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/hotnoodle.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['11']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['11']['price'] ?>&nbsp;×&nbsp;<select class="select11" name="select_hotnoodle">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button12"><p class="result11"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button12').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no11 : $('.select11').val()
              }
            }).done(function(data){
              $('.result11').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
    </ul>
  </div> 
  </div>
  <div class="space1">
    <div class="button"><button type="submit" >注文確認へ</button></div>
  </div>
  </form>
<?php }else { ?>

  <div class="titleback">
  <div class="titlegroup">
    <p class="title">OrderPage</p>
    <div>
      <a href="mypage.php">mypage</a>
      <a href="login.php">/ログアウト</a>
      <a href="manage.php">/予約管理画面</a>
    </div>
  </div>
  </div>
  <div class="space">
    
  </div>
  <form action="order.php" method="POST">
  <div class="image">
  <div class="colorcircle">
    <h2><?php echo $result['0']['store_name'] ?>
    <?php echo $result['0']['store_address'] ?></h2>
    <ul class="colorchart" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/ba2.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['0']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['0']['price'] ?>&nbsp;×&nbsp;<select class="select" name="select_beef_sand">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button1"><p class="result"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button1').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no : $('.select').val()
              }
            }).done(function(data){
              $('.result').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/ba1.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['1']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['1']['price'] ?>&nbsp;×&nbsp;<select class="select1" name="select_salmon_sand">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button2"><p class="result1"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button2').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no1 : $('.select1').val()
              }
            }).done(function(data){
              $('.result1').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      
    </ul>
    <ul class="ulrice" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/rice1.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['2']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['2']['price'] ?>&nbsp;×&nbsp;<select class="select2" name="select_beef_bowl">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button3"><p class="result2"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button3').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no2 : $('.select2').val()
              }
            }).done(function(data){
              $('.result2').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/rice2.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['3']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['3']['price'] ?>&nbsp;×&nbsp;<select class="select3" name="select_salmon_bowl">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button4"><p class="result3"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button4').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no3 : $('.select3').val()
              }
            }).done(function(data){
              $('.result3').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
    </ul>
  </div> 
  </div>
  <div class="space1">
    <div class="button"><button type="submit" >注文確認へ</button></div>
  </div>
  </form>


  <form action="ordernoodle.php" method="POST">
  <div class="image">
  <div class="colorcircle">
    <h2><?php echo $result['1']['store_name'] ?>
    <?php echo $result['1']['store_address'] ?></h2>
    <ul class="colorchart" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/noodle1.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['4']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['4']['price'] ?>&nbsp;×&nbsp;<select class="select4" name="select_noodle1">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button5"><p class="result4"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button5').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no4 : $('.select4').val()
              }
            }).done(function(data){
              $('.result4').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/noodle2.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['5']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['5']['price'] ?>&nbsp;×&nbsp;<select class="select5" name="select_noodle2">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button6"><p class="result5"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button6').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no5 : $('.select5').val()
              }
            }).done(function(data){
              $('.result5').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      
    </ul>
    <ul class="ulrice" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/noodle3.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['6']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['6']['price'] ?>&nbsp;×&nbsp;<select class="select6" name="select_noodle3">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button7"><p class="result6"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button7').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no6 : $('.select6').val()
              }
            }).done(function(data){
              $('.result6').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/noodle4.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['7']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['7']['price'] ?>&nbsp;×&nbsp;<select class="select7" name="select_noodle4">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button8"><p class="result7"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button8').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no7 : $('.select7').val()
              }
            }).done(function(data){
              $('.result7').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
    </ul>
  </div> 
  </div>
  <div class="space1">
    <div class="button"><button type="submit" >注文確認へ</button></div>
  </div>
  </form>


  <form action="orderfly.php" method="POST">
  <div class="image">
  <div class="colorcircle">
    <h2><?php echo $result['2']['store_name'] ?>
    <?php echo $result['2']['store_address'] ?></h2>
    <ul class="colorchart" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/flybowl.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['8']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['8']['price'] ?>&nbsp;×&nbsp;<select class="select8" name="select_flybowl">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button9"><p class="result8"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button9').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no8 : $('.select8').val()
              }
            }).done(function(data){
              $('.result8').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/fly.jpg">
        <div class="sandtext">
          <p class="menue1"><?php echo $allRows['9']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['9']['price'] ?>&nbsp;×&nbsp;<select class="select9" name="select_fly">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button10"><p class="result9"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button10').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no9 : $('.select9').val()
              }
            }).done(function(data){
              $('.result9').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      
    </ul>
    <ul class="ulrice" id="idcolorchart" style="opacity: 0.8">
      <li>
        
        <img src="photo/coldnoodle.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['10']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['10']['price'] ?>&nbsp;×&nbsp;<select class="select10" name="select_coldnoodle">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button11"><p class="result10"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button11').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no10 : $('.select10').val()
              }
            }).done(function(data){
              $('.result10').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
      <li>
        
        <img src="photo/hotnoodle.jpg">
        <div class="ricetext">
          <p class="menue1"><?php echo $allRows['11']['menuename'] ?></p><div class="menue1">Price ¥<?php echo $allRows['11']['price'] ?>&nbsp;×&nbsp;<select class="select11" name="select_hotnoodle">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
          </select>&nbsp;<input type="button" value="小計" class="button12"><p class="result11"></p></div>
        </div>
      </li>
      <script>
        $(function(){
          $('.button12').click(function(){
            $.ajax({
              url: 'ajax/ajax_db.php',
              type: 'GET',
              dataType: 'text',
              data: {
                no11 : $('.select11').val()
              }
            }).done(function(data){
              $('.result11').text(data);
            }).fail(function(data){
              alert('通信失敗');
            });
          });
        });
      </script>
    </ul>
  </div> 
  </div>
  <div class="space1">
    <div class="button"><button type="submit" >注文確認へ</button></div>
  </div>
  </form>
<?php } ?>

	
    
</body>
</html>


