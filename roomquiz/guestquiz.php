<?php

require_once(__DIR__ . '/config.php');

try{
    $quiz = new \MyApp\Quiz();
    $data = $quiz->getCurrentQuiz();
}catch(Exception $e){
    echo $e->getMessage();
    exit;
}

//POSTされたら
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $quiz ->post();
}

//エラーの取得
$err = $quiz->getError();

?>
<!DOCTYPE html>
<html>
    <head class="header">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <title>ゲスト画面</title>
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" type="text/scss" href="../scss/quiz.scss">
        <!--リセット用cssの読込-->
        <link rel='stylesheet' href='https://unpkg.com/ress/dist/ress.min.css'>
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
        <!--エラーの場合メッセージ表示-->
        <?php if(isset($err)) : ?>
        <div class="error"><?= h($err); ?></div>
        <?php endif; ?>
    </header>
        <div class="wrapper">
        <main class="main">
        <div class="box">
            <div class="choice_container">
            <form action="" method="post">
                <div class="row">
                <?php 
                $now_cnt = 0;
                foreach($data['a'] as $a) : ?>
                    <div class="choicebutton" id="<?php echo "btn_".$now_cnt; ?>" data-id="<?php echo $now_cnt?>"><?php echo h($now_cnt + 1)?></div>
                    <?php
                    $now_cnt++;
                endforeach; ?>
                <input type = "hidden" id="answer" name="answer">
                <input type = "hidden" name="token" value="<?= h($_SESSION['token']); ?>">
                </div>  
            </form>
            <script>
            'use strict;'
            $(function(){
            var start_time = performance.now()
            var end_time
            
            $('.choicebutton').on('click',function(){
                    end_time = performance.now();
                    var answer_time = end_time - start_time
                    //var tempTime_date = end_time_date ? start_time_date
                    //alert(answer_time + 'msでした');
                                        
                    $('.choicebutton').removeClass('selected');
                    $(this).addClass('selected');
                    $('#answer').val($(this).data('id'));
                    
                    $('form').submit();//クリックした選択肢を送信
            });
            
            setTimeout(function(){
                if($('#answer').val() === ''){
                    $('#answer').val('');
                    //alert('時間切れです');
                    $('form').submit();//10s経過で空の値を自動的に送信
                }

            },10000);

            $('.error').fadeOut(3000);
        });
            </script>
    </div>
        </div>
        </main>
        </div>
    </body>
</html>
