<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
	<title>今すぐ始める</title>
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
        <h2>今すぐ始める</h2>
		<form action="startnow_confirm.php" method="post">
			<p>ユーザー名：<br><input type="text" name="name"></p>
			<p><input type='button' value="戻る" onClick='history.back()'class=basicbutton>
<input type="button" value="確認" id="button2" class="basicbutton"></p>
		</form>
	</div>
	</main>
	</div>
	<footer class="footer">

	</footer>
</body>
</html>