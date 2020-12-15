<!doctype html>
<html>
<html>
   <head class="header">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
      <title>ランキング</title>
      <link rel="stylesheet" href="../css/style2.css">
      <link rel="stylesheet" href="../css/sidemenu.css">
      <link rel="stylesheet" type="text/scss" href="../scss/quiz.scss">
      <!--リセット用cssの読込-->
      <!--
      <link rel='stylesheet' href='https://unpkg.com/ress/dist/ress.min.css'>
      -->
      <!--jQueryとJavaScriptファイルの読込-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script src="../js/style.js"></script>
      <script src="../js/rank.js"></script>
      <script type="text/javascript" src="../jquery.jaticker_1.0.0/jquery.jaticker_1.0.0.js"></script>
      <link rel="stylesheet" href="../jquery.jaticker_1.0.0/jquery.jaticker_1.0.0.css" type="text/css">
   </head>
<body>
    <header class="header">
    <?php //include(__DIR__ .'/sidemenu.php'); ?>
    <?php include('./sidemenu.php'); ?>
    </header>
      <main>
         <div class="container">
         <div class="rankbox">
         <div class = "ranktitle">
            <span>ランキング</span>
         </div>
         <div class="rank">
         <ol>
            <div class = "one">
            <li>&emsp;Name</li>
            </div>
            <div class ="two"> 
            <li>&emsp;Name</li>
            </div>
            <div class ="theee">
            <li>&emsp;Name</li>
            </div>
            <div class ="four">
            <li>&emsp;Name</li>
            </div>
            <div class ="five">
            <li>&emsp;Name</li>
            </div>
            <div class="six">
            <li>&emsp;Name</li>
            </div>
            <div class="seven">
            <li>&emsp;Name</li>
            </div>
            <div class ="eight">
            <li>&emsp;Name</li>
            </div>
            <div class ="nine">
            <li>&emsp;Name</li>
            </div>
            <div class ="ten">
            <li>&emsp;Name</li>  
            </div>
           
         </ol>
         </div>
      </div>
      <div class="btns">
      <div id="rank_btn" class="wait basicbutton" >Start</div>
      <div id="rank_btn_stop" class="basicbutton" >Stop</div>
      <div id="back_room" class="basicbutton" >Back Wait</div>
      </div>
   </main>
    </div>
   
   <footer class="footer">

   </footer>
</body>
</html>