<?php
require_once(__DIR__ . '/config.php');
//ここにログイン情報
$_SESSION['user_id']= "1";//テスト用ホストのuser_id
?>
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
<div>
        
<?php
//ここからphp

try{
    /*
     ==============================================================
        ルーム作成　DBに登録　ここから
     ==============================================================
     */
        //データベース名を変数に入れる
        $db_name = "quiztool";
        //ユーザー名、パスワードを変数に入れる
        $db_username = "root";
        $db_password = "12345";
        //DB接続
        $pdo = new PDO("mysql:host=localhost; dbname={$db_name}", "{$db_username}", "{$db_password}"); 
    /*    
    //DB接続
    try{
        $pdo = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }catch(\PDOException $e){//エラー
        throw new \Exception('Failed to connect DB');
    }
    */
    /*  DBのテーブルの構造
    ================================================================
    -----------------------------------------------------------------
    「ルーム」テーブル
    {
        ルームID,ルーム名,ルール,説明文,ユーザーID,作成日,更新日,削除日
    }（ルームIDは連番自動生成）
    ----------------------------------------------------------------
    「クイズ」テーブル
    {
        クイズID,ジャンルID,ピリオドID,問題文,補足情報,次クイズID
    }
    ---------------------------------------------------------------
    「出題クイズ」テーブル
    {
        ルームID,クイズID,ピリオドID,クイズ出題順
    }
    ------------------------------------------------------------------
    ==================================================================
    */
    /*
    =================================================================
    newroom.html（ルーム作成画面）
    (テストページ：testdb.html)のフォームにルーム情報を入力
    POST送信{ルーム名、ルール、ピリオド数、説明文}            
    =================================================================
    */

    /*
        htmlspecialcharsでサニタイジングする（未実装）
    */
    //POSTに値があったら
    if(isset($_POST["name"]) && isset($_POST["rule"]) &&  isset($_POST["max_period"]) && isset($_POST["description"])){
        //変数に入れる
        $name = $_POST["name"];//ルーム名
        $rule = $_POST["rule"];//ルール
        $max_period = $_POST["max_period"];//ピリオド数
        $description = $_POST["description"];//説明文

        //「ルーム」テーブルに接続し、登録する。
        //php日付データの取得
        /*
            mysql DATETIME型
                'YYYY-MM-DD HH:MM:SS' 
            php
                date("   ");
        */

        //ログインしているユーザIDの取得
        $user_id = 1;//(テスト用)

        $date_created = "'".date("Y-m-d H:i:s")."'";//作成日時
        $update_date = "'".date("Y-m-d H:i:s")."'";//更新日時
        $deleted_date = NULL;//削除日はNULL
        /*
        「ルーム」テーブル
        {
            ルームID,ルーム名,ルール,説明文,ユーザーID,作成日,更新日,削除日

        }（ルームIDは自動生成）
        */

        //次のルームIDを取得する
        $sql6 ="SHOW TABLE STATUS LIKE 'room'";
        $stmt = $pdo->query($sql6);
        if($stmt){
            while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                //room_idにAuto_incrementの値を代入
                $room_id = $result['Auto_increment'];   
            }
            
        }
        else{
            echo('error. Query_error.');
		    exit(1);
        }
        //ルーム情報を登録する
        $sql = "INSERT INTO room (name, is_fastest_rule, description, user_id, date_created, update_date)VALUES('{$name}', '{$rule}','{$description}', '{$user_id}', {$date_created}, {$update_date})";
        //SQL文確認の為の出力
        //var_dump($sql);
        
        //実行
        $stmt = $pdo->query($sql);
        
        if($stmt){
            print("<h3>ルームを作成しました</h3>");
            //テスト
            while ($row = $stmt->fetchObject()) {
                echo $row->room_id;
                echo $row->name;
                echo $row->description;
            }
                    
            
        }else{
            print("<h3>ルーム作成失敗しました</h3>");
        }
 
    /*
    ========================================================================
      ルーム作成 登録ここまで
    ========================================================================
    */
    //DBから問題を読込、ピリオド毎にシャッフルしてルームで出題するクイズを決定する   
    /*
    =========================================================
    「クイズ」テーブル
    {
        クイズID,ジャンルID,ピリオドID,問題文,補足情報,次クイズID
    }
    =========================================================
    */


//問題情報を引き出す
$sql2 = "SELECT * FROM quiz";
$stmt2 = $pdo->query($sql2);

if($stmt2){
    //print("問題を読み込みました</br>");
}else{
print("<p>問題読込失敗しました</p>");
}
//$stmt = $pdo->query("SELECT * FROM quiz WHERE quiz_id =" .$selected_quiz_num);
//すべての問題を入れる配列を用意
$quizlist=array();

//配列に入れる
$quizlist = $stmt2->fetchAll();

//全てシャッフル
shuffle($quizlist);

//print_r($quizlist);

//連続問題を連続の順番になるよう並び替える
$count = count($quizlist);
$count2 = $count;
for($i = 0; $i < $count; ++$i){
    //もし連続問題だったら
    if($quizlist[$i]['next_quiz_id'] != 0){
        //次のクイズIDを変数に入れる
        $next_quiz_id = $quizlist[$i]['next_quiz_id'];
        //次クイズIDのある配列の要素番号を探す
        $j = 0;//要素の番号を入れる変数
        while($quizlist[$j]['quiz_id'] != $next_quiz_id){
            $j++;
        }
        //見つけた連続問題の次クイズを、
        //連続問題のある要素の一つ後に挿入
        $next_quiz[] = $quizlist[$j];
        array_splice($quizlist,$i+1,0,$next_quiz);
        //確認出力
        //var_dump($quizlist[$i]);
        //var_dump($quizlist[$i+1]);
        //
        //連続問題の後の問題の元の場所削除
        //ただし、入れ替え前に、
        //連続問題の後の問題($j)の場所が前の問題($i)の場所より後ろにあった場合は、
        //消す予定の場所が後ろに１つだけずれているので$j++する
        if($i<$j){
            $j++;
        }
        unset($quizlist[$j]);
        //抜け番を詰める
        $quizlist =array_merge($quizlist);
        //並び替え完了
        //時間がある時に複数連続問題があった場合の修正を行う
    }
    
    
}
//確認出力
//print_r($quizlist);

//ピリオドの数はPOSTによって$maxperiodに入っている
//各ピリオドの問題出題数をランダムで決定する
//3-8問の範囲（仮）
$period_num = 0;
$max_question = 8;//１ピリオドあたりの最大出題数
$min_question = 3;//１ピリオドあたりの最小出題数

/*
============================================================
    問題の出題数を
    データベースにある問題の総数を超えないようにする 
===========================================================
*/



//確認終了
$shufflequiz[] = array();//ルームで出題するクイズをピリオド毎でまとめた配列
$quizlist_num = 0;
$create_date = date("Y-m-d H:i:s"); 
print( "<p>ピリオド数：".$max_period."<p>");
for($period_num = 0; $period_num < $max_period;$period_num++){
    //ピリオド内の問題出題数をランダムで決める
    $num_question = mt_rand($min_question,$max_question);
    print( "<p>ピリオド".($period_num + 1)."の問題数：".$num_question."</p>");
    //$num_question個まで問題を入れる

    //シャッフルした$quizlist[]配列から上から順に必要な分だけ問題情報を取り出す
    /*
    =======================================================
    「出題クイズ」テーブル
    {
        ルームID,クイズID,作成日時,ピリオドID,クイズ出題順

    }
    =======================================================
    */

    for($question = 0; $question < $num_question; $question++){
        //ピリオド〇の△問目という配列↓
        //ピリオド番号が〇([$period_num])の△問目（[$question]問目）=>二次元配列
        //更に問題の内容が連想配列で入るので三次元配列？
        
        //room_id
        $shufflequiz[$period_num][$question]['room_id'] = $room_id;
        //quiz_id
        $shufflequiz[$period_num][$question]['quiz_id'] = $quizlist[$quizlist_num]['quiz_id'];
        //date
        $shufflequiz[$period_num][$question]['date'] = $create_date;
        //period
        $shufflequiz[$period_num][$question]['period'] = $period_num + 1;
        //order
        $shufflequiz[$period_num][$question]['order'] = $question + 1;

        $quizlist_num++;
    }
    
}
//print_r($quizlist);
/*
=========================================================================
    出題するクイズを画面にテーブルで出力 ここから
=======================================================================
*/
//出力
print("<table border='1'>");
print("<tr class='table_title'>");
    //項目名
    print("<th>ピリオド</th>");
    print("<th>出題No.</th>");
    print("<th>問題</th>");
    print("<th>選択肢１</th>");    
    print("<th>選択肢２</th>");    
    print("<th>選択肢３</th>");    
    print("<th>選択肢４</th>");  
    print("<th>正解選択肢</th>");  
    print("<th>補足</th>");
print("</tr>");
foreach($shufflequiz as $value){ 
foreach($value as $value2){
print("<tr>");
    print("<td>");
    print("{$value2["period"]}");//出題されるピリオド
    print("</td>");
    print("<td>");
    print("{$value2["order"]}");//ピリオド内での出題順
    print("</td>");
    print("<td>");
    //---------------------------------------------------------------------
    //  問題文を検索ここから
    //----------------------------------------------------------------------
    $sql3 = "SELECT * FROM quiz WHERE quiz_id = {$value2['quiz_id']}";
    $stmt3 = $pdo->query($sql3);
    if($stmt3){
        while ($row = $stmt3->fetchObject()) {
            printf($row->question);
        }
    }else{
    print("読込失敗しました");
    }
    print("</td>");
    //----------------------------------------------------------------------
    //  問題文検索ここまで
    //--------------------------------------------------------------------------------
    //  選択肢検索 ここから
    //--------------------------------------------------------------------------------
    $sql4 = "SELECT * FROM choice_text WHERE quiz_id = {$value2['quiz_id']}";
    $stmt4 = $pdo->query($sql4);
    $i = 1;
    if($stmt4){
    while ($row = $stmt4->fetchObject()) {
        print("<td>");
            $choice_text=$row->text;
            if($row->is_img_exists == 1){//画像フラグが立っている場合
                //選択肢画像テーブルを検索

                $sql5 = "SELECT * FROM choice_img WHERE quiz_id = {$value2['quiz_id']}";
                $stmt5 = $pdo->query($sql4);
                if($stmt5){
                    while ($row = $stmt5->fetchObject()) {
                        if($row->choice_num == $i){//選択肢&iの場合
                            printf($row->img);
                        }else{
                            print("画像読込失敗しました");
                        }
                    }
                }else{
                    //画像読込失敗
                    //(quizテーブルのtextを出力する)
                    printf($choice_text);
                }
            }
            else{//選択肢がテキストのみの場合
                if($row->choice_num == $i){//選択肢$iの場合
                    printf($choice_text);
                    
                }
            }
            $i++;
    
        print("</td>");  
        if($i > 4){
            break;  
        }
    }
    }
    else{
    print("読込失敗しました");
    }
    if($i < 5){//選択肢が4つ以下の場合、<td></td>で埋める
        for($i;$i < 5;$i++){
            print("<td></td>");
        }
    }
    //------------------------------------------------------------------------------------------
    //  選択肢検索ここまで
    //--------------------------------------------------------------------------
    //  正解選択肢検索  ここから
    //  正解の選択肢番号を表示する　
    //-----------------------------------------------------------------------------
    print("<td>"); 
    $sql4 = "SELECT * FROM choice_text WHERE quiz_id = {$value2['quiz_id']}";
    $stmt4 = $pdo->query($sql4);
    if($stmt4){
        while ($row = $stmt4->fetchObject()) {
            if($row->is_correct == 1){
                $correct = $row->choice_num;
            }
        }
        print($correct);
    }else{
    print("読込失敗しました");
    }
    print("</td>");
    //-----------------------------------------------------------------------
    //  正解選択肢　ここまで
    //----------------------------------------------------------------------
    //  補足を検索　ここから
    //------------------------------------------------------------------------
    print("<td>");
    $sql3 = "SELECT * FROM quiz WHERE quiz_id = {$value2['quiz_id']}";
    $stmt3 = $pdo->query($sql3);  
    if($stmt3){
        while ($row = $stmt3->fetchObject()) {
            printf($row->information);
        }
    }else{
    print("読込失敗しました");
    }
    print("</td>");
    //------------------------------------------------------------------------
    //  補足を検索　ここまで
    // -----------------------------------------------------------------------
    print("</tr>");
}
}
print("</table>");
/*
=======================================================================
    出題クイズ出力ここまで
=======================================================================
*/
//戻るボタン
print('<a href="newroom.html" class="basicbutton">戻る</a>');
print("　　　");
/*
========================================================================
    INSERTでルームで出題するクイズを登録する　ここから
========================================================================
 */
//var_dump($shufflequiz);
try {
    $sql = "INSERT INTO room (name, is_fastest_rule, description, user_id,date_created,update_date)VALUES('{$name}', '{$rule}','{$description}', '{$user_id}', {$date_created}, {$update_date})";
    $sql7 = "INSERT INTO `quiz_served` (`room_id`, `quiz_id`,`date`, `period`,`order`) VALUES ";
    foreach ($shufflequiz as $value)
    {
        foreach($value as $val){
        $query_values[] = "(" . $val['room_id'] . "," . $val['quiz_id']. ",'" . $val['date']. "'," . $val['period']. "," . $val['order'] . ")";
        }
    }
    $sql7 = $sql7 . implode(",", $query_values);
    //var_dump($sql7);
    
    $stmt7 = $pdo->query($sql7);

    if($stmt7){
        //echo "出題するクイズをデータベースに登録しました";
        //ホスト待機画面に遷移するボタン
        print('<a href="roomquiz/wait.php"class=submitbutton>確認</a>');
    }
    else{
        print("<p>"."出題クイズ登録失敗しました"."</p>") ;
    }
    
    //print_r($shufflequiz_val);
    //echo "出題するクイズをデータベースに登録しました";

} catch (Exception $e) {
    echo"</br>";
    print("<p>"."出題クイズ登録失敗しました"."</p>") ;
    var_dump($e);
}


/*
========================================================================
    INSERTでルームで出題するクイズを登録する　ここまで
========================================================================
 */

}
//POSTに値が入っていない場合
else {
    //エラーメッセージ表示
    print("<h2>入力内容が不足しているか誤りがあります</h2></br>");
    //戻るボタン
    print('<a href="javascript:history.back();"class=basicbutton>戻る</a>');
}


$pdo = null;


}catch(PDOException $e){
    print($e->getMessage());
    die();
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