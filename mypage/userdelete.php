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
         <h2>アカウント削除</h2>
         <div class="subbox">
         <h3>アカウントを削除します</h3>
         <div class="pass">
         パスワード：<input type = "password" name = "pass" maxlength="65">
         </div>
         <!--↓戻るボタン　#の中にPHPを入れてね！-->
         <div type='button' onClick='history.back()'class=btn-square-pop>戻る</div>
         <!--戻るボタン終わり・削除ボタン-->
         <a href="userdeleteok.php" class="btn-square-pop-d">削除</a>
         <!--削除ボタン終わり-->
         </div>
      </div>

    </main>
    </div>
   <footer class="footer">

   </footer>
</body>
</html>