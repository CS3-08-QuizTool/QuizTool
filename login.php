<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <title>ログイン</title>
        <link rel ="stylesheet" href ="css/style.css"> 
        <!--
            <link rel="stylesheet" href="css/stle.css">
        -->
    </head>
    <body>
        <header class="header">
            <!--サイドメニューの読み込み-->
            <?php include(__DIR__ .'/sidemenu.php'); ?>
        </header>
         <div class="box">
        <h2>ログイン</h2>
        <form action="login_confirm.php" method="post">
            <div><p>情報を入力してください</p></div>
            <div><p><label for="email">メールアドレス:</label>
            <input type="email" name="email"></p></div>
            <div><p><label for="password"> パスワード(8文字):</label>
            <input type="password" name="password"></p></div>
            <input type='button' value="戻る" onClick='history.back()'class=basicbutton>
            <button type="submit" class="login basicbutton">ログイン</button>
        </form>
        </div>
    </body>
</html>