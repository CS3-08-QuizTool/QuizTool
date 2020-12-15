<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title class="title">クイズツール</title>
    <link rel="stylesheet" href="css/style.css">
    <!--jQueryとJavaScriptファイルの読込-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="js/style.js"></script>
    
</head>
<body>
    <header class="header">
      <!--サイドメニューの読み込み-->
      <?php include(__DIR__ .'/sidemenu.php'); ?>
    </header>

    <div class="wrapper">
    <main class="main">
      
      <div class="box">
         <h1>クイズツール</h1>
         <div class="buttons">
            <a href="signup.php" class="signupbutton">新規登録</a>
            <a href="login.php" class="loginbutton">ログイン</a>
            <a href="startnow.php" class="startnowbutton">今すぐ始める</a>
         </div>
      </div>

    </main>
    </div>
   <footer class="footer">

   </footer>
</body>
</html>