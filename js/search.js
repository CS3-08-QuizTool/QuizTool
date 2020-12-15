$(function() {
  'use strict';
  

 //ルームトップの入室ボタンは検索前は非表示
 document.getElementById("submit_room").style.visibility ="hidden";
 //ルームトップのルーム検索ボタン
 $(":button[name='search_post']").click(function(){
  //フォーム入力から値を引き出す
  let id_value = "";
  let name_value = "";
  id_value = $(":text[name='id']").val();
  //name_value = $(":text[name='name']").val();

  //Ajax PHPに渡す
  $.ajax({
    type: "POST",
    url: "../roomquiz/search.php",
    dataType : "json",
    //contentType: "Content-Type: application/json; charset=UTF-8",
    data:{
      'room_id':id_value,
      //'room_name':name_value
    }

}).done(function (data) {
  let test = data.id;//出力テスト
  console.log(test)
    
  $("#id").text(data.id);
  $("#name").text(data.name);
  $("#rule").text(data.rule);
  $("#description").text(data.description);

  document.getElementById("room_id").setAttribute("value", data.id);
  document.getElementById("room_name").setAttribute("value", data.name);

  document.getElementById('submit_room').style.visibility = 'visible';


}).fail(function (XMLHttpRequest,textStatus,errorThrown) {
    alert('error');
});

});
//ルームトップのルーム検索ボタンここまで



 
}); // jQuery load