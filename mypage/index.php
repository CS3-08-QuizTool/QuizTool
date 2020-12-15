<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title class="title">クイズツール（仮）</title>
    <link rel="stylesheet" href="../css/stylesub.css">
    <!--jQueryとJavaScriptファイルの読込-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../js/style.js"></script>
</head>
<body>
    <header class="header">
    <?php
       include('./sidemenu.php');
      ?>
    </header>
    
    <div class="wrapper">
    <main class="main">
      <div class="box">
         <div class = "actitle"><h2>アカウント</h2></div>
        <div class = "user"><h3>username</h3></div>
        <div class ="seiseki">
          <a class="ssbtn" href="#">成績</a>
         </div>
        <div class = "quizhistory">
          <a class="ssbtn" href="userrooms.php">作成済みルーム</a>
        </div> 
        <div class ="userrooms">
          <a class="ssbtn" href="#">アカウント変更</a>
        </div>
        <div class ="userdelete">
          <a class="ssbtn" href="userdelete.php">アカウント削除</a>
        </div>
        <div class = "topbut">
          <a class="topbutton" href="../index.php">トップに戻る</a>
        </div>
      </div>

    </main>
    </div>
   <footer class="footer">

   </footer>
</body>
</html>