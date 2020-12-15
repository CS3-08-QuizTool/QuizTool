<?php
//ブラウザでエラー表示ができるようにする
ini_set('display_errors', 1);

//SESSION
session_start();

//DB
define('DSN','mysql:host=localhost; dbname=quiztool');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '12345');

//エスケープのファイル読み込み
require_once(__DIR__ . '/functions.php');
//オートロード
require_once(__DIR__ . '/autoload.php');

?>