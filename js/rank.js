$(function() {
  'use strict';
  var music = new Audio();//音楽再生インスタンス作成

  function init() {
    music.preload = "auto";
    music.src = "../audio/rank_10-4_bgm.mp3";
    music.load();
  
    music.addEventListener("ended", function () {//再生終了時イベント
      music.currentTime = 0;
      music.play();
    }, false);
    
  }
  function play() {
    music.loop = true;//ループ
    music.play();
  }
  
  function stop() {
    music.pause();
    music.currentTime = 0;
  }
  
  init();
  
  //ランキング画面のNextボタン
  $('#rank_btn').on('click',function(){
   play();
 }); 
  //ランキング画面のNextボタンここまで
  $('#rank_btn_stop').on('click',function(){
    stop();
  }); 
  $('#back_room').on('click',function(){
    location.href="wait.php";
  }); 




 
}); // jQuery load