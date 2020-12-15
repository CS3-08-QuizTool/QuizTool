<?php
//読込
require_once(__DIR__ . '/config.php');//エラー表示とデータを表示する時のエスケープ

$quiz = new MyApp\Quiz();//インスタンス生成　名前空間「MyApp」
//$search = new Search\Search();//インスタンス生成　名前空間「MyApp」

/*
if(isset($_POST['room_id'])){
  $test = $search->searchQuizRoom();
}
*/

//ここにログイン情報が入る
$_SESSION['user_id'] = '1';//テスト用ホストのuser_id
//$_SESSION['user_id'] = '2';//テスト用ゲストのuser_id

//function searchQuizRoom();
//テキストボックスに入力した単語でルームを検索する


?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>ルームトップ</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/style.css">
<!--jQueryとJavaScriptファイルの読込-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../js/style.js"></script>
<script src="../js/quiz.js"></script>
<script src="../js/search.js"></script>
</head>
<body>
<header class="header">
<!--サイドメニューの読み込み-->
<?php include(__DIR__ .'/sidemenu.php'); ?>
<script>

</script>
</header>
<div class="box">
  <h3>ルーム検索</h3>
  <!--ルーム名でも検索できるようにする-->
  <div>
  <form action="" method="post" id="search">
  <dl>  
    <dt>ルームID</dt>
    <dd><input type="text" name="id" value="" size="10" /></dd>
    <!--
    <dt>ルーム名</dt>
    <dd><input type="text" name="name" value="" size="16" /></dd>
    -->
  </dl>
  <input type="button" name="search_post" class="basicbutton_mini" value="検索" />
  </form>

<!--
  <p>
    <label for="room_id">ルームID:</label>
    <input type="text" id="room_id">
    <button type="button" class="basicbutton" id="search_quizroom">検索</button>
  </p>
-->
  </div>
  <div id="quizroom_table">
    <table>
      <tr class="heading">
        <th>ルームID</th>
        <th>ルーム名</th>
        <th>ルール</th>
        <th>説明文</th>
        <th>入室</th>
      </tr>
      <tr>
        <form action="wait.php" method="post">
        <td id="id"></td>
        <td id="name"></td>
        <td id="rule"></td>
        <td id="description"></td>
        <input id="room_id" name="room_id"  type="hidden" />
        <input id="room_name" name="room_name"  type="hidden" />
        <td><input type="submit" id="submit_room" class="basicbutton_mini" value="入室" /></td>
        </form>
      </tr>

    </table>
    <!--
    <form action="wait.php" method="post">
      <select name="room_id">
        <option value="1">ROOM1</option>
        <option value="2">ROOM2</option>
        <option value="3">ROOM3</option>
      </select>
      <input type="submit" class="basicbutton" value="入室"/>
    </form>
-->
  </div>
<h3>
    <a href="../newroom.html" >ルーム作成</a>
</h3>
<input type='button' value="戻る" onClick='history.back()'class=basicbutton>


</body>
</html>