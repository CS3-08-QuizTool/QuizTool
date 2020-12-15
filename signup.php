<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <title>新規登録</title>
    <link rel="stylesheet" href="css/style.css">
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
        <h2>新規登録</h2>
        <h3>情報を入力してください</h3>
        <form action ="signup_confirm.php" method ="post">
        <p>
        ユーザー名:<input type="text" name ="name" size ="40">
        </p>
        <p>
        パスワード:<input type="password" name="pass" size="30" maxlength="8"></p>
        <small>(半角英数字をそれぞれ1文字以上含んだ8文字以上にしてください)</small>
        <p>
        メールアドレス:<input type="text" name ="name" size ="40">
        </p>
        <input type='button' value="戻る" onClick='history.back()'class=basicbutton>
        <input class="basicbutton" type="submit" value="登録">
    </form>
    </div>
    </main>
    </div>
    <footer class="footer">

    </footer>
</body>
</html>