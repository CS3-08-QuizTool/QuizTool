<?php
//読込
require_once(__DIR__ . '/config.php');//エラー表示とデータを表示する時のエスケープ

$_SESSION['user_id'] = '1';//ホストのuser_id
//$_SESSION['user_id'] = '2';//ゲストのuser_id

?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
<title>待機画面</title>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/style.css">
<!--jQueryとJavaScriptファイルの読込-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="../js/style.js"></script>

<?php 
if (empty($_POST["room_id"])) {
  $room_id = "3";//テスト用ルームのroom_id
} else {
  $room_id = $_POST["room_id"];//入室しているルームID
}

$send_param["room"] = $room_id;

?>
<script type="text/javascript">
/*
var conn = "";

function open(){
　//接続にルーム情報を載せる
　conn = new WebSocket('ws://localhost:8282?<?php echo(http_build_query($send_param))?>');
    

    conn.onopen = function(e) {
    };

    conn.onerror = function(e) {
    alert("エラーが発生しました");
    };

    conn.onmessage = function(e) {//webSocketサーバーからsendがあった場合に自動的に実行
        var data = JSON.parse(e.data);
        var divObj = document.createElement("DIV");
        divObj.className = 'receive-msg-left';
        var msgSplit = data["msg"].split('\n');
        for (var i in msgSplit) {
            var msg = document.createTextNode(msgSplit[i]);
            var rowObj = document.createElement("DIV");
            rowObj.appendChild(msg);
            divObj.appendChild(rowObj);
        }

        var msgLog = document.getElementById("msg_log");
        msgLog.appendChild(divObj);

        var br = document.createElement("BR");
        br.className = 'br';
        msgLog.appendChild(br);

        msgLog.scrollTop = msgLog.scrollHeight;

    };

    conn.onclose = function() {
        alert("切断しました");
        setTimeout(open, 5000);
    };

}

/*
function send(){
    conn.send(document.getElementById("msg").value);//webSocketサーバーにデータを送信
}
*/
/*
function send(){
    conn.send($send_param["room_id"]);//webSocketサーバーにデータに開始の合図を送る
    window.location.href = './hostquiz.php';
}

function close(){
    conn.close();
}

*/
</script>
</head>
<body>
<header class="header">
<!--サイドメニューの読み込み-->
<?php include(__DIR__ .'/sidemenu.php'); ?>
</header>
<main>
<?php //if($quiz->isHost($_SESSION['user_id'])) : ?>
<?php if($_SESSION['user_id'] == '1') : ?>　<!--テスト用-->
<!--ホストの場合の画面-->
    <div class="box">
        <div class="waitbox">
        <h3>testroomに入室中です</h3>
        <div class="startbtn">
            <a href="hostquiz.php"class="go">開始</a>
        </div>
        <!--ここに現在待機中のゲストを表示する-->
        <p>現在入室中のゲスト</p>

        <div class="in_guestbox">
        <ul>
            <li>Guest 1 <li>Guest 2 <li>Guest 3 <li>Guest 4 <li>Guest 5
            <li>Guest 6 <li>Guest 7 <li>Guest 8 <li>Guest 9 <li>Guest 10
        </ul>
        </div>
        
        <button type="button" class="basicbutton" onclick="history.back()">戻る</button> 
        </div>
    </div>
<?php else : ?>
<!--ゲストの場合の画面-->
    <div class="box">
        <div>
        <h3>testroomに入室中です</h3>
        </div>
        <h2>開始まで</br>しばらくお待ちください</h2>
        <button type="button" class="basicbutton" onclick="history.back()">戻る</button> 
    </div>
	<div id="message_box" style="background-color:#FFF"></div>
<?php endif; ?>
</main>
</body>
</html>