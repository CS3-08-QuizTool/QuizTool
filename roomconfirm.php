<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>テスト</title>
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
        
<?php
//ここからphp

try{
/*
    htmlspecialcharsでサニタイジングする（未実装）
*/
//POSTに値があったら
if(isset($_POST["name"]) && isset($_POST["rule"]) &&  isset($_POST["max_period"]) && isset($_POST["description"])){
    //変数に入れる
    $name = $_POST["name"];//ルーム名
    $is_fastestrule = $_POST["rule"];//ルール
    $max_period = $_POST["max_period"];//ピリオド数
    $description = $_POST["description"];//説明文
    
    if($is_fastestrule){//ルールが早押しなら
        $rule = "早押し";
    }else{
        $rule = "正解数";
    }
    print("<h3>ルーム作成　内容確認</h3>");
    print("<h3>こちらの内容でよろしいでしょうか</h3>");

    $str = <<<EOT
    <table border=1 >
    <tr><th class='table_title'>ルーム名</th><td>$name</td></tr>
    <tr><th class='table_title'>ルール</th><td>$rule</td></tr>
    <tr><th class='table_title'>ピリオド数</th><td>$max_period</td></tr>
    <tr><th class='table_title'>説明</th><td>$description</td></tr>
    </table>
EOT;

    print($str ."</br>");
    $str2 = <<<EOT
    <form action="roomquiz_confirm.php" method="post">
    <input type="hidden" name="name" value=$name>
    <input type="hidden" name="rule" value=$is_fastestrule>
    <input type="hidden" name="max_period" value=$max_period>
    <input type="hidden" name="description" value=$description>
    <input type='button' value="戻る" onClick='history.back()'class=basicbutton>
    <input type="submit" value="確定" class=submitbutton>
    </form>
EOT;
    print($str2);
}
//POSTに値が入っていない場合
else {
    //エラーメッセージ表示
    print("</br></br><p>入力内容が不足しているか誤りがあります</p>");
    //戻るボタン
    echo"</br>";
    print('<a href="javascript:history.back();" class=basicbutton>戻る</a>');
}

} catch (Exception $e) {
echo"</br>";
var_dump($e);
}



//phpここまで

?>

</div>
</main>
</div>
<footer class="footer">

</footer>
</body>
</html>