<!DOCTYPE html>
<html>
    <head class="header">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <title>ルーム作成</title>
        <link rel="stylesheet" href="css/style.css">
            <!--jQueryとJavaScriptファイルの読込-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="js/style.js"></script>
    </head>
    <body>
    <header>
    <!--サイドメニューの読み込み-->
    <?php include(__DIR__ .'/sidemenu.php'); ?>
    </header>
        <div class="wrapper">
        <main class="main">
        <div class="box">
            <h2>ルーム作成</h2>
                <form action="roomconfirm.php" method="POST">
                    <label for="name">
                        ルーム名：
                        <input type="text" id="name" name="name">
                    </label>
                    </br>
                    <label for="rule">
                        ルール：
                        <input type="radio" name ="rule" value="0">正解数
                        <input type="radio" name ="rule" value="1">早押し
                    </label>
                    </br>
                    <label for="max_period">
                        ピリオド数：
                        <select name= "max_period">
                            <option selected value = "1">1</option>
                            <option value = "2">2</option>
                            <option value = "3">3</option>
                            <option value = "4">4</option>
                            <option value = "5">5</option>
                        </select>
                    </label>
                    </br>
                    <label for="description">
                        説明文：
                        <textarea id="description" name="description"></textarea>
                    </label>
                    </br>
                    </br>
                    <input type='button' value="戻る" onClick='history.back()'class=basicbutton>
                    <input type="submit" value="確認" class="submitbutton" >
                </form>
        </div>
        </main>
        </div>
    </body>
</html>