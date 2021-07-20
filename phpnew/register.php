<?php session_start();
   
   
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>register</title>
  <!-- ?v=2 -> スタイルシートの都度更新 -->
  <link rel="stylesheet" type="text/css" href="base.css?v=2">
  <link rel="stylesheet" type="text/css" href="css/register.css?v=2">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">

    $(function(){
      

      $(".submit").mouseover(function(){
        $(this).css("cursor","pointer")
      });

      $(".sousin123").mouseover(function(){
        $(this).css("cursor","pointer")
      });

      
    });
    

  

  </script>
</head>
<body>


  

  <?php
    $nameError =  $mailError = $passError = $confpassError = $addressError = "";
    $error = array();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $pName = $_POST["name1"];
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
        $_SESSION["mail"] = $pMail;
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

      if(empty($pAddress)){
        $error[] = $addressError = "住所の入力は必須です";
      }else{
        $_SESSION["address"] = $pAddress;
      }


      if(empty($error)){
        $_SESSION["validation"] = 1;
        header("location: confirm.php");
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


  <header></header>

  <div class="mainback">
  <div class="text">

    <p style="text-align: center; color: red; font-size: 15px" ><?php if(isset($_SESSION['mailerror'])): ?>登録失敗<?php endif ?></p>

  <div class="toiawase">
    <div class="toiawasegroup">
      <p class="toiawasep">新規登録</p>
    </div>
    
    <div class="toiawase1">
      <div class="titleback">
       <p class="soushinn">下記の項目をご記入の上確認ボタンを押してください</p>
      </div>
      
     
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, 'UTF-8');?>" method="post"accept-charset="utf-8" onsubmit="return pre()">
      <ul class="contactlist">

        <li>
          <label for="name1">氏名<span>*</span></label>
        
          <p class="error">
            <?php if(isset($nameError)): ?>
              <?php echo $nameError; ?>
            <?php endif ?>
          </p>
          <input type="text" name="name1" class="liinput" value="<?php if(isset($_SESSION['name1'])){echo htmlspecialchars($_SESSION['name1']);} ?>">
        </li>

        
        <li>
          <label for="mail">メールアドレス<span>*</span></label>
          <p class="error">
            <?php if(isset($mailError)): ?>
              <?php echo $mailError; ?>
            <?php endif ?>
          </p>
          <input type="text" name="mail" class="liinput" value="<?php if(isset($_SESSION['mail'])){ echo htmlspecialchars($_SESSION['mail']); } ?>">
        </li>

        <li>
          <label for="address">住所<span>*</span></label>
          <p class="error">
            <?php if(isset($addressError)): ?>
              <?php echo $addressError; ?>
            <?php endif ?>
          </p>
          <input type="type" name="address" class="liinput" value="<?php if(isset($_SESSION['address'])){ echo htmlspecialchars($_SESSION['address']); }?>">
        </li>

        <li>
          <label for="pass">パスワード<span>*</span></label>
          <p class="error">
            <?php if(isset($passError)): ?>
              <?php echo $passError; ?>
            <?php endif ?>
          </p>
          <input type="password" name="pass" class="liinput" value="<?php if(isset($_SESSION['pass'])){ echo htmlspecialchars($_SESSION['pass']); } ?>">
        </li>


        <li>
          <label for="confpass">確認用パスワード<span>*</span></label>
          <p class="error">
            <?php if(isset($confpassError)): ?>
              <?php echo $confpassError; ?>
            <?php endif ?>
          </p>
          <input type="password" name="confpass" class="liinput" value="<?php if(isset($_SESSION['confpass'])){ echo htmlspecialchars($_SESSION['confpass']); } ?>">
        </li>

      </ul>
      
      
      <div class="submitgroup">
       <button type="submit" class="submit">確認</button>
      </div>
     </form>
    </div>
    <div class="modoru" style="text-align: center;"><a href="login.php">戻る</a></div>
  </div>
  </div>
  </div>
  <footer></footer>
</body>
</html>