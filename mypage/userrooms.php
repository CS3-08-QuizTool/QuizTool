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
       include(__DIR__ .'/sidemenu.php');
      ?>
    </header>

    <div class="wrapper">
    <main class="main">
        
      <div class="box">
         <div class = "actitle"><h2>作成済みルーム</h2></div>        <div class ="scroll">
          <div class="txt">作成済みルームを選択してください：</div>  
    <!--ルーム名入れる-->
  <select name ="room" >
  <option>クリックして選択</option>
   <option>room1</option><br>
   <option>room2</option><br>
   <option>room3</option><br>
   <option>room4</option><br>
   <option>room5</option><br>
   </select>
  </div>
  <div class="txt2">ルール</div>
  <div class="radio">
    <form action="#" method="POST">
      <input type="radio" name = "rule" value="1">正解数
      <input type="radio" name = "rule" value="2">早押し
    </div>  
    </form>
  <div class ="txt3">説明文</div>
  <div class="txtbox">
    <textarea name="setumei" rows="4" cols="40">ここに説明文「てょわわわ〜ん」</textarea>
      </div>
      <div class="henko">
        <a href="#" class="henkobtn">変更</a>
      </div>
     <div class="gostr">
       <a href="#"class="go">開始！</a>
       </a>
     </div>
    <div class = "backbtn">
      <a type='button' onClick='history.back()'class=back>戻る</a>
    </div>

</div>
    </main>
    </div>
   <footer class="footer">

   </footer>
</body>
</html>