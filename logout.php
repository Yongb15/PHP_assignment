<?php
  session_start();                         // 세션 시작
  
  // 세션에서 각 사용자 정보를 해제합니다.
  unset($_SESSION["userid"]);              // userid 해제
  unset($_SESSION["username"]);            // username 해제
  unset($_SESSION["userlevel"]);           // userlevel 해제
  unset($_SESSION["userpoint"]);           // userpoint 해제
  
  // 인덱스 페이지로 리디렉션함
  echo("
       <script>
          location.href = 'index.php';      // index.php 페이지로 이동
       </script>
       ");
?>
