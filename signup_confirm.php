<?php 
  ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <title>ログイン</title>
        <link rel ="stylesheet" href ="css/style.css"> 
    </head>
    <body>
    <header class="header">
        <!--サイドメニューの読み込み-->
        <?php include(__DIR__ .'/sidemenu.php'); ?>
    </header>
      <div class="box">
    <h2>ログイン</h2>
    
    <?php
    
    require_once('config.php');
    //データベースへ接続、テーブルがない場合は作成
    try {
      $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->exec("create table if not exists userDeta(
          id int not null auto_increment primary key,
          email varchar(255),
          password varchar(255),
          created timestamp not null default current_timestamp
        )");
    } catch (Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }
    //POSTのValidate。
    if (!$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      echo '入力された値が不正です。';
      return false;
    }
    //パスワードの正規表現
    if (preg_match('/\A(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,100}+\z/i', $_POST['password'])) {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    } else {
      echo 'パスワードは半角英数字をそれぞれ1文字以上含んだ8文字以上で設定してください。';
      return false;
    }
    //登録処理
    try {
      $stmt = $pdo->prepare("insert into userDeta(email, password) value(?, ?)");
      $stmt->execute([$email, $password]);
      echo '登録完了';
    } catch (\Exception $e) {
      echo '登録済みのメールアドレスです。';
    }
    echo "<input type='button' value='戻る' onClick='history.back()'class=basicbutton>";


    ?>


    </div>
    </body>
</html>
