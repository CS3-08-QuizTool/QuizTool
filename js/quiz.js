$(function() {
  'use strict';
  var music_ansNum = new Audio();//音楽再生インスタンス作成
  var music_ansOpen = new Audio();//音楽再生インスタンス作成

  function init() {
    music_ansNum.preload = "auto";
    music_ansNum.src = "../audio/answercheck_response_num.mp3";
    music_ansOpen.preload = "auto";
    music_ansOpen.src = "../audio/answercheck_answer_open.mp3";
    music_ansOpen.volume = 0.3;//音量調整
    music_ansNum.load();
    music_ansOpen.load();
  
    /*
    music.addEventListener("ended", function () {//再生終了時イベント
      music.currentTime = 0;
      //music.play();
    }, false);
    */
  }
  /*
  function playAnsNum() {
    //music.loop = true;//ループ
    music_ansNum.play();
  }
  
  function stopAnsNum() {
    music_ansNum.pause();
    music_ansNum.currentTime = 0;
  }
  function playAnsOpen() {
    //music.loop = true;//ループ
    music_ansNum.play();ljhus

  }
  
  function stopAnsOpen() {
    music_ansNum.pause();
    music_ansNum.currentTime = 0;
  }
  */

  init();

  //ホストクイズ画面のNextボタン
  $('#next_btn').on('click',function(){
    //選択肢番号部分
    let element_choice0 = document.getElementById('c0');
    let element_choice1 = document.getElementById('c1');
    let element_choice2 = document.getElementById('c2');
    let element_choice3 = document.getElementById('c3');
    //選択肢テキスト部分
    let element_q = document.getElementById('jaticker-q');
    let element_0 = document.getElementById('jaticker-0');
    let element_1 = document.getElementById('jaticker-1');
    let element_2 = document.getElementById('jaticker-2');
    let element_3 = document.getElementById('jaticker-3');
    //Nextボタン
    let elementNext = document.getElementById('next_btn');
    //カウントダウン
    let elementCnt = document.getElementById('counter');
    //以下イベント発生用チェック項目
    let resultq = element_q.classList.contains('disabled');
    let result0 = element_0.classList.contains('disabled');
    let result1 = element_1.classList.contains('disabled');
    let result2 = element_2.classList.contains('disabled');
    let result3 = element_3.classList.contains('disabled');
    let resultWait = elementNext.classList.contains('wait');
    let resultNoCnt = elementCnt.classList.contains('disabled_cnt');
    let resultCheckAnswer = elementNext.classList.contains('checkAnswer');
    let resultChecked = elementNext.classList.contains('checked');
    let resultansMus = elementNext.classList.contains('ansMusic');
    
    if(resultq){//問題文表示
      $('#jaticker-q').removeClass('disabled');
      $('#jaticker-q').jaticker();
      //ボタンの表示「Ready Go」
      elementNext.innerHTML = "Ready Go";
    }
    if(result0 && !resultq){
      //選択肢表示
      $('#jaticker-0').removeClass('disabled');//選択肢１
      $('#jaticker-1').removeClass('disabled');//選択肢２
      $('#jaticker-2').removeClass('disabled');//選択肢３
      $('#jaticker-3').removeClass('disabled');//選択肢４

      //カウントダウン開始
      $('#counter').removeClass('disabled_cnt');
       elementCnt.classList.add('nums');
       //カウントダウンする秒数
       var sec = 10;
       //開始日時を設定
       var dt = new Date();
       // 終了時刻を開始日時+カウントダウンする秒数に設定
       var endDt = new Date(dt.getTime() + sec * 1000);
       // 1秒おきにカウントダウン
       var cnt = sec;
       var id = setInterval(function(){
          cnt--;
          //cntNum.innerHTML = cnt;
          console.log(cnt);
          // 現在日時と終了日時を比較
          dt = new Date();
          if(dt.getTime() >= endDt.getTime()){
            //カウントダウン終了
            clearInterval(id);
            //ボタンの表示を「Answer Check」にする
            elementNext.classList.add('checkAnswer');
            elementNext.innerHTML = "Answer Check";
          }
       }, 1000);
    }
    if(!resultansMus && !resultChecked && resultCheckAnswer && !resultNoCnt && resultWait  && !resultq && !result0 && !result1 && !result2 && !result3){
      //もしcheckAnswerボタンを押したら
      //解答人数の音楽
      $('#ans_cnt-0').text('4');
      $('#ans_cnt-1').text('1');
      $('#ans_cnt-2').text('3');
      $('#ans_cnt-3').text('5');

      $('#ans_cnt-0').removeClass('disabled');
      $('#ans_cnt-1').removeClass('disabled');
      $('#ans_cnt-2').removeClass('disabled');
      $('#ans_cnt-3').removeClass('disabled');
      music_ansNum.play();

  
      elementNext.classList.add('ansMusic');
    } 
    if(resultansMus &&!resultChecked && resultCheckAnswer && !resultNoCnt && resultWait  && !resultq && !result0 && !result1 && !result2 && !result3){
      music_ansOpen.play();
      $('#next_btn').removeClass('ansMusic');

      //正解表示のAjax処理
      $.post('./_answer.php',{

      }).done(function(res){
        //alert(res.correct_answer);//テスト用
        
        //alert(res.choice_size);//テスト用

        let i = 0;//選択肢ループで見る（０～３）
        let char2  = '.textContent';//テキスト部分変更する属性

        //正解選択肢選択肢番号専用
        let char1_choice = 'element_choice';
        let choice_num = '';//選択肢の指定

        //正解選択肢テキスト部分専用
        let char1 = 'element_';
        let choice_char = '';//選択肢の指定
        let choice_char_content = '';

        for(i = 0; i < res.choice_size; i++){
          choice_num = eval(char1_choice + i)
          choice_char = eval(char1 + i);
          choice_char_content = eval(char1 + i + char2);
          if(choice_char_content == res.correct_answer){
            //正解選択肢を強調表示
            choice_char.classList.add('correct');
            choice_num.classList.add('correct');
          }
          else{
            //不正解選択肢はグレーで目立たなくする
            choice_char.classList.add('wrong');
          }
        }

        //ボタンの表示を「Next Quiz」にする
        elementNext.innerHTML = "Next Quiz";
        elementNext.classList.add('checked');
      });
    }
    if(resultChecked && resultCheckAnswer && !resultNoCnt && resultWait  && !resultq && !result0 && !result1 && !result2 && !result3){
    //もしNex Quizボタンを押したら
       //次の問題に行けるようにする
       
       $('#next_btn').removeClass('wait');
       if (resultCheckAnswer) {
        location.reload();
       }  
    }
 }); 
 //ホストクイズ画面のNextボタンここまで




 
}); // jQuery load