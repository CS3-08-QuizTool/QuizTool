<?php

//namespace Search;
require_once(__DIR__ . '/config.php');

$db;
$room = [];
$list = [];
$room_id;
$room_name;
//DB接続
try{
    $db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
}catch(\PDOException $e){//エラー
    throw new \Exception('Failed to connect DB');
}


//searchQuizRoom
$id = $_POST['room_id'];
//$name = $_POST['room_name'];
//$list = array("id" => $id, "name" => "お名前", "hoge" => "ほげ" );

    
$sql = "SELECT * FROM room WHERE room_id = {$id}";
$stmt = $db->query($sql);
if($stmt){
    $room = array();
    //room配列に情報を格納する
    foreach($stmt as $val) {
        $room['room_id'] = $val['room_id'];
        $room['name'] = $val['name'];
        $room['rule'] = $val['is_fastest_rule'];
        $room['description'] = $val['description'];
    }
    //ルールの識別
    if($room['rule'] == "1"){
        $rule= "早押し";
    }else{
        $rule = "正解数";
    }
    //json
    header("Content-type: application/json; charset=UTF-8");
    $list = array(
        "id" => $room['room_id'],
        "name" => $room['name'],
        "rule" => $rule,
        "description" => $room['description']
    );
    echo json_encode($list);

}
else{
    $id= "error";
    header("Content-type: application/json; charset=UTF-8");
    $list = array("id" => "error");

    echo json_encode($list);
}
exit;

/*
// 明示的に指定しない場合は、text/html型と判断される
header("Content-type: application/json; charset=UTF-8");
//JSONデータを出力
echo json_encode($list);
exit;
*/



/*
//POSTされたら検索する
if(isset($_POST['room_id'])){
    $room_id = $_POST['room_id'];
    
$sql_room = "SELECT * from room
WHERE room_id = {$this->_room_id}";
$stmt_room = $this->_db->query($sql);
if($stmt_room){

    $id= "success";
    $room = array();
    foreach($stmt_room as $val) {
        //$this->$room['room_id'] = $val['room_id'];
    }
    //json
    header("Content-type: application/json; charset=UTF-8");
    $list = array("id" => "success");

    echo json_encode($list);

}
else{
    $id= "error";
    header("Content-type: application/json; charset=UTF-8");
    $list = array("id" => "error");

    echo json_encode($list);
}


//json
header("Content-type: application/json; charset=UTF-8");
$list = array("id" => "false");

echo json_encode($list);

exit;

}
*/










?>