<?php

namespace MyApp;

class Quiz{
    private $_db;
    private $_quizSet = [];//privateなのでアンダースコア
    public function __construct(){
        $this->_connectDB();//DB接続
        Token::create();

        /*
        $room_id = 2;//テスト用待機画面から持ってくる
        $user_id = 2;//SESSIONログインで持ってくる
        $date = "20f20-11-16 00:40:53";//SESSIONで持ってくる
        */
        
        if(!isset($_SESSION['room_id'])){//テスト用
            $_SESSION['room_id'] = 3;
        }
        if(!isset($_SESSION['user_id'])){//テスト用
            $_SESSION['user_id'] = 2;
        }
        if(!isset($_SESSION['date'])){//テスト用
            $_SESSION['date'] = "2020-11-18 23:33:45";
        }

        $this->_setup();//データをセット

        if (!isset($_SESSION['current_num'])) {
            $this->_initSession();
        }
        /*
        if (!isset($_SESSION['current_period'])) {
            $this->_initSession_p();
        }
        */

    }

    //問題を取得する
    public function getCurrentQuiz(){
        //return $this->_quizSet[$_SESSION['current_period']][$_SESSION['current_num']];
        return $this->_quizSet[$_SESSION['current_num']];
    }
    //問題の選択肢の数を取得する
    public function getCurrentChoiceSize(){
        //return $this->_quizSet[$_SESSION['current_period']][$_SESSION['current_num']];
        //return $this->count(_quizSet[$_SESSION['current_num']]['a']);
        //return $this->_quizSet[$_SESSION['current_num']]['a'];
        return '4';

    }

    //データをセットするprivate関数
    private function _setup(){

        //出題クイズテーブルから、ルームID・作成日時をもとに問題を検索
        $sql2 = "SELECT * FROM quiz_served 
        WHERE `room_id` = :room_id AND `date` = :created_date";
        $stmt2 = $this->_db->prepare($sql2);
        $stmt2->bindValue(':room_id', $_SESSION['room_id']);
        $stmt2->bindValue(':created_date', $_SESSION['date']);
        $stmt2->execute();
        $room_quizlist=array();
        $room_quizlist = $stmt2->fetchAll();
        $max_count = count($room_quizlist);//用意されている問題数の取得
        /*
        $period = array();//ピリオド順キー配列
        $order = array();//出題順のキー配列
        foreach ($room_quizlist as $key => $value) {
            $period[$key] = $value['period'];
            $order[$key] = $value['order'];
        }
        //キー配列をもとに並び替え
        array_multisort( $period,$order, SORT_ASC, $room_quizlist);//ピリオド昇順ソート
        //確認出力
        //print_r($room_quizlist);
        $question = array();
        $choices = array();
        $choice_array = array();
        foreach($room_quizlist as $key => $value){ 
            $period = $value['period'];
            $order = $value['order'];
            //echo  "ピリオド：".$value['period'] ."クイズID：".$value['quiz_id'] ." ";
            $_quizSet[$period][$order]['quiz_id'] = $value['quiz_id'];
            //問題文の検索
            $sql3 = "SELECT * FROM quiz WHERE `quiz_id` = {$value['quiz_id']}";
            $stmt3 = $this->_db->query($sql3);
            $question = $stmt3->fetchAll();
            foreach ($question as $key_q => $value_q) {
                $_quizSet[$period][$order]['q'] = $value_q['question'];
            }
            //選択肢の検索
            $sql4 = "SELECT * FROM choice_text WHERE `quiz_id` = {$value['quiz_id']}";
            $stmt4 = $this->_db->query($sql4);
            $choices = $stmt4->fetchAll();
            asort($choices);
            //var_dump($choices);
            foreach ($choices as $key_c => $value_c) {
                array_push($choice_array, $value_c['text']);
            }
            $_quizSet[$period][$order]["a"] = array();
            foreach($choice_array as $value ){
                array_push($_quizSet[$period][$order]["a"], $value);
            }
            $choice_array = null;
            $choice_array = array();
            //var_dump($choices);

            
        }

        //var_dump($_quizSet);
        */
        $this->_quizSet[] =[//テストデータ配列
            'quiz_id'=>'1',
            'q'=>'お酒は熱燗、柑橘系はキンカン。では、宅急便を持ってくるのは？',
            'a'=>['ペリカン','クロネコ','カンガルー','人間'],
            'correct_choice'=>'人間'
        ];
        $this->_quizSet[] =[
            'quiz_id'=>'5',
            'q'=>'ことわざで、世の中の移り変わりが激しいことのたとえを「世の中はなに見ぬ間に桜かな」という？',
            'a'=>['竜巻','三日','幻','隣人'],
            'correct_choice'=>'三日'
        ];
        $this->_quizSet[] =[
            'quiz_id'=>'15',
            'q'=>'次のうち世界一広い湖はどれでしょう？',
            'a'=>['カスピ海','スペリオル湖','ビクトリア湖','ヒューロン湖'],
            'correct_choice'=>'カスピ海'
        ];
        
    }

    //問題カウント初期化
    private function _initSession() {
        $_SESSION['current_num'] = 0;
        $_SESSION['correct_count'] = 0;
    }
    //ピリオドカウント初期化
    private function _initSession_p() {
        $_SESSION['current_period'] = 0;
    }

    //ホスト解答答え合わせ
    public function HostCheckAnswer() {
        //Token::validate('token');
        $correctAnswer = $this->_quizSet[$_SESSION['current_num']]['correct_choice'];
        //$correctAnswer = $this->_quizSet[$_SESSION['current_period']['current_num']]['a'][0];
        return $correctAnswer;
    }

    //ゲスト解答答え合わせ
    public function GuestCheckAnswer() {
        //Token::validate('token');
        $correctAnswer = $this->_quizSet['current_num']['correct_choice'];
        //$correctAnswer = $this->_quizSet[$_SESSION['current_period']['current_num']]['a'][0];
        if (!isset($_POST['answer'])) {
          throw new \Exception('answer not set!');
        }
        if ($correctAnswer === $_POST['answer']) {//正解なら
          $_SESSION['correct_count']++;//正解数＋１
        }
        $_SESSION['current_num']++;
        return $correctAnswer;
    }
    
    //終了
    public function isFinished() {
        //return count($this->_quizSet[$_SESSION['current_period']]) === $_SESSION['current_num'];
        return count($this->_quizSet) === $_SESSION['current_num'];

    }
    public function getScore() {
    return round($_SESSION['correct_count'] / count($this->_quizSet) * 100);
    }
    public function isLast() {
        //return count($this->_quizSet[$_SESSION['current_period']]) === $_SESSION['current_num'] + 1;
        return count($this->_quizSet) === $_SESSION['current_num'] + 1;

    }
    //現在の問題数と正解数のカウントのセッションをリセット
    public function reset() {
    $this->_initSession();
    }
    //次の問題に進めるようにする処理
    public function add_current_num() {
        $_SESSION['current_num']++;
    }
    
    //ユーザー解答POSTされたら
    public function post(){//endFlg = 1でguestresult?
        try{
            //$this->_validateToken();
            //$this->_validateAnswer();
            //$this->_save();
            //redirect
            //最後までいったらguestresult.php
            //header('Location: http://' .$_SERVER['HTTP_HOST'] . '\guestresult.php');
            header('Location: http://' .$_SERVER['HTTP_HOST'] .$_SERVER['PHP_SELF']);//テスト用リロード
        }catch(\Exception $e){
            //set Error
            $_SESSION['err'] = $e->getMessage();
            //redirect to index.php
            header('Location: http://' .$_SERVER['HTTP_HOST'] .$_SERVER['PHP_SELF']);//テスト用リロード
        }
        exit;
    }

    //エラー取得
    public function getError(){
        $err = null;
        if(isset($_SESSION['err'])){
            $err = $_SESSION['err'];
            unset($_SESSION['err']);
        }
        return $err;
    }

    //DB接続
    private function _connectDB(){
        try{
            $this->_db = new \PDO(DSN, DB_USERNAME, DB_PASSWORD);
            $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);//エラーでExCEPTIONを返す
        }catch(\PDOException $e){//エラー
            throw new \Exception('Failed to connect DB');
        }
    }

    //解答の値チェック
    private function _validateAnswer(){
        var_dump($_POST);//回答受渡しテスト
        exit;
        if(
            !isset($_POST['answer']) ||//POSTの値がセットされているか
            !in_array($_POST['answer'],[0, 1, 2, 3])//渡された値が選択肢のうちのいずれかか
        ){
            throw new Exception('invalid answer!');
        }
    }
    //解答のDB登録
    private function _save(){
        $sql = "insert into user_answer
            (user_id, room_id, date, answer_num, answer_time)
            values(:user_id, :room_id, :date, answer_num, answer_time)";
        /*
        $stmt = $this->_db->prepare($sql);
        $stmt->bindValue(':answer_num', (int)$_POST['answer'], \PDO::PARAM_INT);
        $stmt->execute();
        exit;
        */
    }



}

?>
