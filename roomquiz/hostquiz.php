<?php
//読込
require_once(__DIR__ . '/config.php');//エラー表示とデータを表示する時のエスケープ

$quiz = new MyApp\Quiz();//インスタンス生成　名前空間「MyApp」

if(!$quiz->isFinished()){//すべてのクイズが終了していなかったら
   $data = $quiz->getCurrentQuiz();
   //shuffle($data['a']);//選択肢のシャッフル
}
try{
    $quiz = new \MyApp\Quiz();
}catch(Exception $e){
    echo $e->getMessage();
    exit;
}

//POSTされたら
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $poll ->post();
}

?>
<!DOCTYPE html>
<html>
   <head class="header">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
      <title>ホスト画面</title>
      <link rel="stylesheet" href="../css/style.css">
      <link rel="stylesheet" type="text/scss" href="../scss/quiz.scss">
      <!--リセット用cssの読込-->
      <!--
      <link rel='stylesheet' href='https://unpkg.com/ress/dist/ress.min.css'>
      -->
      <!--jQueryとJavaScriptファイルの読込-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
      <script src="../js/style.js"></script>
      <script type="text/javascript" src="../jquery.jaticker_1.0.0/jquery.jaticker_1.0.0.js"></script>
      <link rel="stylesheet" href="../jquery.jaticker_1.0.0/jquery.jaticker_1.0.0.css" type="text/css">
   </head>
   <body>
   <header>
      <!--サイドメニューの表示-->
      <?php include(__DIR__ .'/sidemenu.php'); ?>
   </header>
      <div class="wrapper" id="wrapper">
      <main class="main">
      <?php if($quiz->isFinished()) : ?>　<!--クイズ終了-->
         <?php header('Location: rank.php'); ?>
         <!--結果画面に移行-->
      <?php $quiz->reset(); ?><!--テスト用問題リセット-->
      <?php else : ?>
      <?php //$quiz->add_current_num();?>
         <div id="quiz_container">
         <div class="question_box" ><p id="jaticker-q" class="disabled"><?= h($data['q']); ?></p></div>
         <ol class="choices">
               <?php 
               $now_cnt = 0;
               foreach($data['a'] as $a) : ?>
                  <li class=<?php echo"c".$now_cnt;?> id=<?php echo"c".$now_cnt;?>><span class="<?php echo "disabled choice"."$now_cnt"; ?>" id="<?php echo "jaticker-".$now_cnt; ?>"><?= h($a); ?></span><span id="<?php echo "ans_cnt-".$now_cnt; ?>" class="disabled ans_cnt">2</span></li>
               <?php
               $now_cnt++;
               endforeach; ?>
         </ol>

         <!--カウントダウンタイマ-->
         
         <div id="counter" class="disabled_cnt">
            <span>&emsp;&emsp;0</span>
            <span>&emsp;&emsp;1</span>
            <span>&emsp;&emsp;2</span>
            <span>&emsp;&emsp;3</span>
            <span>&emsp;&emsp;4</span>
            <span>&emsp;&emsp;5</span>
            <span>&emsp;&emsp;6</span>
            <span>&emsp;&emsp;7</span>
            <span>&emsp;&emsp;8</span>
            <span>&emsp;&emsp;9</span>
            <span>&emsp;&emsp;10</span>
         </div>
         <!--カウントダウンタイマここまで-->
         <!--次の問題へ行くボタン-->
         <div id="next_btn" class="wait">Next</div>
         <script src="../js/quiz.js"></script>
      </div>
      <?php endif; ?>
      </main>
      </div>
    </body>
</html>
