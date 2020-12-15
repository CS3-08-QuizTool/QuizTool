 <!-- ハンバーガーメニュー ここから-->
 <div id="menu-container">
   <div id="menu-wrapper">
      <div id="hamburger-menu"><span></span><span></span><span></span></div>
      <!-- hamburger-menu -->
   </div>
   <!-- menu-wrapper -->
   <ul class="menu-list accordion">
      <li id="nav1" class="toggle accordion-toggle"> 
         <span class="icon-plus"></span>
         <a class="menu-link" href="../index.php">HOME</a>
      </li>
      <!-- accordion-toggle -->
      <ul class="menu-submenu accordion-content">
         <li><a class="head" href="../index.php">トップページ</a></li>
         <li><a class="head" href="../signup.php">新規登録</a></li>
         <li><a class="head" href="../login.php">ログイン</a></li>
         <li><a class="head" href="../startnow.php">今すぐ始める</a></li>
      </ul>
      <!-- menu-submenu accordon-content-->
      <li id="nav2" class="toggle accordion-toggle"> 
         <span class="icon-plus"></span>
         <a class="menu-link" href="../roomquiz/index.php">ルーム</a>
      </li>
      <!-- accordion-toggle -->
      <ul class="menu-submenu accordion-content">
         <li><a class="head" href="../roomquiz/index.php">ルーム検索</a></li>
         <li><a class="head" href="../newroom.php">ルーム作成</a></li>
         <!--
         <li><a class="head" href="roomedit.php">ルーム編集</a></li>
         -->
         <li><a class="head" href="../better-error-pages/maintenance.html">ルーム編集</a></li>
      </ul>
      <!-- menu-submenu accordon-content-->
           <li id="nav3" class="toggle accordion-toggle"> 
         <span class="icon-plus"></span>
         <a class="menu-link" href="../mypage/index.php">アカウント</a>
      </li>
      <!-- accordion-toggle -->
      <ul class="menu-submenu accordion-content">
      <!--
         <li><a class="head" href=<?php// echo $_SERVER['DOCUMENT_ROOT']."/quiztool/mypage/index.php"?>>マイページトップ</a></li>
      -->
         <li><a class="head" href="../mypage/index.php">マイページトップ</a></li>
         <!--
         <li><a class="head" href="../mypage/userresult.php">成績</a></li>
         -->
         <li><a class="head" href="../better-error-pages/maintenance.html">成績</a></li>
         <!--
         <li><a class="head" href="../mypage/userrooms.php">作成済みルーム一覧</a></li>
         -->
         <li><a class="head" href="../better-error-pages/maintenance.html">作成済みルーム一覧</a></li>
         <!--
         <li><a class="head" href="../mypage/usersetting.php">アカウント情報変更</a></li>
         -->
         <li><a class="head" href="../better-error-pages/maintenance.html">アカウント情報変更</a></li>
         <li><a class="head" href="../mypage/userdelete.php">アカウント削除</a></li>
      </ul>
      <!-- menu-submenu accordon-content-->
      <li id="nav4" class="toggle accordion-toggle"> 
         <span class="icon-plus"></span>
         <a class="menu-link" href="../index.php">ログアウト</a>
      </li>
      <!-- accordion-toggle -->
   </ul>
   <!-- menu-list accordion-->
</div>
<!-- menu-container -->    
<!-- ハンバーガーメニュー ここまで-->