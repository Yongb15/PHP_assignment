<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>음악 공연 홍보 및 예약</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
  function check_input() {                          // 사용자가 제목과 내용을 입력했는지 확인하는 함수
      if (!document.board_form.subject.value) {
          alert("제목을 입력하세요!");                  // 입력을 안할 시 경고창 출력
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value) {
          alert("내용을 입력하세요!");                  // 입력을 안할 시 경고창 출력
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();                 // 제목과 내용이 모두 입력되었으면 폼을 제출
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php"; ?>                  <!-- header.php 포함 -->
</header>  
<section>
    <div id="main_img_bar">
        <img src="./data/JJanggu.jpg" width="500px" height="180px"> <!-- 메인 이미지 삽입 -->
    </div>
    <div id="board_box">
        <h3 id="board_title">
                자유게시판 > 글 쓰기
        </h3>
        <form name="board_form" method="post" action="board_insert.php" enctype="multipart/form-data"> <!-- 이상이 없을 시 board_insert.php로 전송 -->
             <ul id="board_form">
                <li>
                    <span class="col1">이름 : </span>
                    <span class="col2"><?=$username?></span> <!-- 세션에서 가져온 사용자 이름 -->
                </li>        
                <li>
                    <span class="col1">제목 : </span>
                    <span class="col2"><input name="subject" type="text"></span> <!-- 제목 입력 필드 -->
                </li>        
                <li id="text_area">    
                    <span class="col1">내용 : </span>
                    <span class="col2">
                        <textarea name="content"></textarea> <!-- 내용 입력 필드 -->
                    </span>
                </li>
                <li>
                    <span class="col1"> 첨부 파일</span>
                    <span class="col2"><input type="file" name="upfile"></span> <!-- 파일 첨부 필드 -->
                </li>
                </ul>
            <ul class="buttons">
                <li><button type="button" onclick="check_input()">완료</button></li> <!-- 완료 클릭 시 check_input 함수 호출 -->
                <li><button type="button" onclick="location.href='board_list.php'">목록</button></li> <!-- 목록 클릭 시 board_list.php로 이동 -->
            </ul>
        </form>
    </div> <!-- board_box -->
</section> 
<footer>
    <?php include "footer.php"; ?> <!-- footer.php 포함 -->
</footer>
</body>
</html>
